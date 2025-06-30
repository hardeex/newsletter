<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsLetterWelcomeEmail extends Mailable
{
    use SerializesModels;

    // You can pass any data to the email, e.g., the user name
    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function build()
    {
        return $this->view('emails.newsletter-welcome')
                    ->subject('Welcome to Essential Nigeria!')
                    ->with([
                        'email' => $this->email,
                    ]);
    }
}
