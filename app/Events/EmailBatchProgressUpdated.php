<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EmailBatchProgressUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $batchId;
    public $sentEmails;
    public $failedEmails;
    public $totalEmails;

    public function __construct($batchId, $sentEmails, $failedEmails, $totalEmails)
    {
        $this->batchId = $batchId;
        $this->sentEmails = $sentEmails;
        $this->failedEmails = $failedEmails;
        $this->totalEmails = $totalEmails;
    }

    public function broadcastOn()
    {
        return new Channel('email-batch.' . $this->batchId);
    }
}