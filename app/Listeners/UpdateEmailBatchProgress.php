<?php

namespace App\Listeners;

use App\Events\EmailBatchProgressUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateEmailBatchProgress
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmailBatchProgressUpdated $event)
{
    Log::info("Progress update: batch {$event->batchId}, sent: {$event->sentCount}, failed: {$event->failedCount}");
}
}
