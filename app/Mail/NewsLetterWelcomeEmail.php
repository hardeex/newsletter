<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsLetterWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

   public function build()
{
    return $this->view('emails.newsletter-email')  
        ->subject('Welcome to Essential Nigeria!')
        ->with([
            'email' => $this->subscriber->email,
            'unsubscribeLink' => route('unsubscribe', ['token' => $this->subscriber->unsubscribe_token]),
        ]);
}

}
