<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\BulkEmail;
use App\Models\EmailBatch;
use Illuminate\Support\Facades\DB;
use App\Events\EmailBatchProgressUpdated;

class SendBulkEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emails;
    protected $subject;
    protected $content;
    protected $batchId;

    public function __construct($emails, $subject, $content, $batchId)
    {
        $this->emails = $emails;
        $this->subject = $subject;
        $this->content = $content;
        $this->batchId = $batchId;
    }

    public function handle()
    {
        $batch = EmailBatch::findOrFail($this->batchId);
        
        if ($batch->status === 'cancelled') {
            return;
        }

        $batch->update(['status' => 'processing']);
        
        $sentCount = 0;
        $failedCount = 0;
        $failures = [];

        foreach ($this->emails as $email) {
            try {
                Mail::to($email)->queue(new BulkEmail($this->subject, $this->content));
                $sentCount++;
            } catch (\Exception $e) {
                $failedCount++;
                $reason = $e->getMessage();
                $failures[] = [
                    'email_batch_id' => $this->batchId,
                    'email' => $email,
                    'reason' => substr($reason, 0, 255),
                    'created_at' => now(),
                ];
            }
        }

        // Update batch counts atomically
        DB::transaction(function () use ($sentCount, $failedCount, $failures) {
            $batch = EmailBatch::lockForUpdate()->findOrFail($this->batchId);
            $batch->sent_emails += $sentCount;
            $batch->failed_emails += $failedCount;
            $batch->save();

            if (!empty($failures)) {
                DB::table('email_batch_failures')->insert($failures);
            }

            // Check if all emails are processed
            $totalProcessed = $batch->sent_emails + $batch->failed_emails;
            if ($totalProcessed >= $batch->total_emails) {
                $batch->update([
                    'status' => 'completed',
                    'completed_at' => now()
                ]);
            }
            
            // Broadcast progress update
            event(new EmailBatchProgressUpdated(
                $this->batchId,
                $batch->sent_emails,
                $batch->failed_emails,
                $batch->total_emails
            ));
        });
    }
}