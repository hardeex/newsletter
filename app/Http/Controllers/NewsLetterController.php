<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NewsLetterWelcomeEmail;
use Illuminate\Validation\ValidationException;
use App\Mail\WelcomeEmail;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class NewsLetterController extends Controller
{
    public function subscribe(Request $request)
    {
        try {
            // Validate the incoming data
            $validated = $request->validate([
                'email' => 'required|email|unique:subscribers,email',
            ]);
    
            // Create the new subscriber
            $subscriber = Subscriber::create([
                'email' => $validated['email'],
            ]);
    
            // Send the welcome email
            Mail::to($subscriber->email)->send(new NewsLetterWelcomeEmail($subscriber->email));
    
            // Return a success response
            return response()->json([
                'message' => 'You have successfully subscribed to the newsletter!',
            ], 201); // HTTP status 201 for resource creation
    
        } catch (ValidationException $e) {
            // Validation error handling
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // General error handling
            return response()->json([
                'message' => 'An error occurred. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
