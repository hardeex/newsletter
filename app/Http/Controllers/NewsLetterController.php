<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NewsLetterWelcomeEmail;
use App\Models\IpBlocklist;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use ReCaptcha\ReCaptcha;

class NewsLetterController extends Controller
{
    

    public function subscribe(Request $request)
{
    // Check for duplicate or blacklisted IPs
    $ipAddress = $request->ip();
    if (IpBlocklist::where('ip_address', $ipAddress)->exists()) {
        return response()->json(['message' => 'Your IP has been blacklisted.'], 403);
    }

    // Honeypot: Check if the hidden field is filled (bot trap)
    if ($request->filled('honeypot')) {
        return response()->json(['message' => 'Bot detected. Subscription rejected.'], 400);
    }

    // Validate incoming data (email, platform)
    $validated = $request->validate([
        'email' => 'required|email',  // This checks if the email already exists in the DB
        'platform' => 'required|string',
        'honeypot' => 'nullable|string|in:','',  // Honeypot field
    ]);

    // Check if email already exists before proceeding (for custom message)
    $existingSubscriber = Subscriber::where('email', $validated['email'])->first();

    if ($existingSubscriber) {
        // If email is already subscribed, check if it's unsubscribed
        if ($existingSubscriber->status === 'unsubscribed') {
            // Re-subscribe the user
            $existingSubscriber->update(['status' => 'subscribed', 'ip_address' => $ipAddress, 'user_agent' => $request->userAgent()]);
            // Send the welcome email again
            Mail::to($existingSubscriber->email)->queue(new NewsLetterWelcomeEmail($existingSubscriber));

            return response()->json([
                'message' => 'This email is already subscribed, but we’ve resent the welcome email!',
            ], 200);  // Custom 200 OK response
        }

        // Email is already subscribed, so return a custom 400 Bad Request
        return response()->json([
            'message' => 'This email is already subscribed.',
        ], 400);  // Return 400 for already subscribed
    }

    // Generate unsubscribe token
    $token = Str::random(60);

    try {
        // Create the new subscriber
        $subscriber = Subscriber::create([
            'email' => $validated['email'],
            'platform' => $validated['platform'],
            'unsubscribe_token' => $token,
            'ip_address' => $ipAddress,
            'user_agent' => $request->userAgent(),
        ]);

        // Log the created subscriber to debug
        Log::info('New subscriber created:', $subscriber->toArray());

        // Send the welcome email
        Mail::to($subscriber->email)->queue(new NewsLetterWelcomeEmail($subscriber));

        // Return success response
        return response()->json(['message' => 'Successfully subscribed!'], 201);
    } catch (\Exception $e) {
        // Log the error
        Log::error('Failed to subscribe: ' . $e->getMessage());

        return response()->json([
            'message' => 'An error occurred while processing your subscription.',
        ], 500);
    }
}





    public function unsubscribe($token)
    {
        try {
            $subscriber = Subscriber::where('unsubscribe_token', $token)->firstOrFail();
            $subscriber->update(['status' => 'unsubscribed']);

            return response()->json([
                'message' => 'You have been successfully unsubscribed.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid or expired unsubscribe link.',
            ], 404);
        }
    }
}