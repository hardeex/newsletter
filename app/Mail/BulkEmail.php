<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class BulkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;

    public function __construct($subject, $content)
    {
        $this->subject = $subject;
        $this->content = $content;
    }

    public function build()
    {
        // Add List-Unsubscribe header for deliverability
        $unsubscribeToken = Str::random(60);
        $unsubscribeUrl = route('newsletter.unsubscribe', ['token' => $unsubscribeToken]);

        return $this->subject($this->subject)
                    ->html($this->content)
                    ->withSwiftMessage(function ($message) use ($unsubscribeUrl) {
                        $headers = $message->getHeaders();
                        $headers->addTextHeader('List-Unsubscribe', "<$unsubscribeUrl>");
                        $headers->addTextHeader('List-Unsubscribe-Post', 'List-Unsubscribe=One-Click');
                    });
    }
}