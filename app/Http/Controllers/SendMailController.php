<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BulkEmail;
use App\Models\IpBlocklist;
use App\Models\Subscriber;
use App\Models\EmailList;
use App\Models\EmailListSubscriber;
use App\Models\EmailBatch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use League\Csv\Reader;
use Illuminate\Support\Facades\RateLimiter;
use App\Jobs\SendBulkEmailJob;
use App\Events\EmailBatchProgressUpdated;

class SendMailController extends Controller
{
    /**
     * Handle bulk email sending
     */
    public function send(Request $request)
    {
        // Rate limiting: max 5 bulk sends per hour per IP
        $ipAddress = $request->ip();
        $rateLimitKey = 'bulk-email:' . $ipAddress;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            return response()->json([
                'message' => 'Too many attempts. Please try again later.'
            ], 429);
        }

        // Check for blacklisted IPs
        if (IpBlocklist::where('ip_address', $ipAddress)->exists()) {
            return response()->json([
                'message' => 'Your IP has been blacklisted.'
            ], 403);
        }

        // Validate input
        $validated = $request->validate([
            'input_method' => 'required|in:manual,csv,database',
            'emails' => 'required_if:input_method,manual|array',
            'emails.*' => 'email',
            'csv_file' => 'required_if:input_method,csv|file|mimes:csv,txt|max:10240',
            'database_list_id' => 'required_if:input_method,database|exists:email_lists,id',
            'subject' => 'required|string|max:60', // Short subject for deliverability
            'content' => 'required|string|not_regex:/(free|win|urgent|click now)/i', // Avoid spam words
            'list_name' => 'required_if:input_method,manual|required_if:input_method,csv|string|max:100|nullable',
            'schedule_at' => 'nullable|date|after:now',
        ]);

        try {
            // Start database transaction
            DB::beginTransaction();

            $userId = auth()->id();
            $emails = [];
            $listId = null;

            // Handle different input methods
            switch ($validated['input_method']) {
                case 'manual':
                    $emails = $this->handleManualInput($validated['emails'], $validated['list_name'], $userId);
                    $listId = $emails['list_id'];
                    $emails = $emails['emails'];
                    break;

                case 'csv':
                    $emails = $this->handleCsvUpload($request->file('csv_file'), $validated['list_name'], $userId);
                    $listId = $emails['list_id'];
                    $emails = $emails['emails'];
                    break;

                case 'database':
                    $emails = EmailListSubscriber::where('email_list_id', $validated['database_list_id'])
                        ->pluck('email')
                        ->toArray();
                    $listId = $validated['database_list_id'];
                    break;
            }

            // Remove duplicates and unsubscribed users
            $emails = array_unique($emails);
            $unsubscribed = Subscriber::whereIn('email', $emails)
                ->where('status', 'unsubscribed')
                ->pluck('email')
                ->toArray();
            $emails = array_diff($emails, $unsubscribed);

            // Cap at 1M emails
            if (count($emails) > 1000000) {
                throw ValidationException::withMessages([
                    'emails' => 'Cannot send to more than 1 million emails at once.'
                ]);
            }

            // Group emails by domain for rate limiting
            $emailsByDomain = [];
            foreach ($emails as $email) {
                $domain = strtolower(substr(strrchr($email, "@"), 1));
                $emailsByDomain[$domain][] = $email;
            }

            // Create email batch record
            $batch = EmailBatch::create([
                'user_id' => $userId,
                'email_list_id' => $listId,
                'subject' => $validated['subject'],
                'content' => $validated['content'],
                'total_emails' => count($emails),
                'sent_emails' => 0,
                'failed_emails' => 0,
                'status' => 'pending',
                'scheduled_at' => $validated['schedule_at'] ?? null,
            ]);

            // Dispatch jobs with domain-based rate limiting
            $chunkSize = 500; // Process 500 emails per job
            $delay = 0;
            foreach ($emailsByDomain as $domain => $domainEmails) {
                $domainChunks = array_chunk($domainEmails, $chunkSize);
                foreach ($domainChunks as $chunk) {
                    // Limit to 100 emails/hour per domain
                    $domainRateLimitKey = "bulk-email-domain:{$domain}:{$batch->id}";
                    if (RateLimiter::tooManyAttempts($domainRateLimitKey, 100)) {
                        $delay += 3600; // Delay by 1 hour if rate limit exceeded
                    }
                    SendBulkEmailJob::dispatch($chunk, $validated['subject'], $validated['content'], $batch->id)
                        ->delay($validated['schedule_at'] ?? now()->addSeconds($delay));
                    RateLimiter::hit($domainRateLimitKey, 3600);
                    $delay += 2; // Stagger jobs by 2 seconds
                }
            }

            // Update rate limiter for IP
            RateLimiter::hit($rateLimitKey, 3600);

            DB::commit();

            // Broadcast initial progress
            event(new EmailBatchProgressUpdated($batch->id, $batch->sent_emails, $batch->failed_emails, $batch->total_emails));

            return response()->json([
                'message' => 'Bulk email sending scheduled successfully.',
                'batch_id' => $batch->id,
                'total_emails' => count($emails)
            ], 202);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk email sending failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get batch status with progress
     */
    public function getBatchStatus($batchId)
    {
        $batch = EmailBatch::where('id', $batchId)
            ->where('user_id', auth()->id())
            ->first();

        if (!$batch) {
            return response()->json([
                'message' => 'Batch not found or unauthorized.'
            ], 404);
        }

        $failedReasons = DB::table('email_batch_failures')
            ->where('email_batch_id', $batchId)
            ->select('reason', DB::raw('count(*) as count'))
            ->groupBy('reason')
            ->get();

        return response()->json([
            'batch_id' => $batch->id,
            'status' => $batch->status,
            'total_emails' => $batch->total_emails,
            'sent_emails' => $batch->sent_emails,
            'failed_emails' => $batch->failed_emails,
            'progress' => [
                'sent' => $batch->sent_emails . '/' . $batch->total_emails,
                'failed_details' => $failedReasons->map(function ($item) {
                    return [
                        'reason' => $item->reason,
                        'count' => $item->count
                    ];
                })->toArray()
            ],
            'scheduled_at' => $batch->scheduled_at,
            'created_at' => $batch->created_at,
            'completed_at' => $batch->completed_at
        ]);
    }

    /**
     * Get all email lists for the user
     */
    public function getEmailLists()
    {
        $emailLists = EmailList::where('user_id', auth()->id())
            ->select('id', 'name', 'created_at')
            ->get();

        return response()->json([
            'email_lists' => $emailLists
        ]);
    }

    /**
     * Handle manual email input
     */
    private function handleManualInput(array $emails, string $listName, int $userId)
    {
        // Create or get email list
        $emailList = EmailList::firstOrCreate(
            ['user_id' => $userId, 'name' => $listName],
            ['created_at' => now()]
        );

        // Add emails to list
        $insertData = array_map(function ($email) use ($emailList) {
            return [
                'email_list_id' => $emailList->id,
                'email' => $email,
                'created_at' => now(),
            ];
        }, $emails);

        EmailListSubscriber::insert($insertData);

        return [
            'list_id' => $emailList->id,
            'emails' => $emails
        ];
    }

    /**
     * Handle CSV file upload
     */
    private function handleCsvUpload($file, string $listName, int $userId)
    {
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        $emails = [];

        foreach ($csv as $record) {
            if (isset($record['email']) && filter_var($record['email'], FILTER_VALIDATE_EMAIL)) {
                $emails[] = $record['email'];
            }
        }

        // Create or get email list
        $emailList = EmailList::firstOrCreate(
            ['user_id' => $userId, 'name' => $listName],
            ['created_at' => now()]
        );

        // Add emails to list
        $insertData = array_map(function ($email) use ($emailList) {
            return [
                'email_list_id' => $emailList->id,
                'email' => $email,
                'created_at' => now(),
            ];
        }, $emails);

        EmailListSubscriber::insert($insertData);

        return [
            'list_id' => $emailList->id,
            'emails' => $emails
        ];
    }
}