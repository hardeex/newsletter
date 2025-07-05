<?php

namespace App\Providers;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Configure broadcast routes
        Broadcast::routes(['middleware' => ['auth:sanctum']]);

        // Log queue job status
        Queue::after(function (JobProcessed $event) {
            Log::info('Job processed: ' . $event->job->resolveName());
        });

        Queue::failing(function (JobFailed $event) {
            Log::error('Job failed: ' . $event->job->resolveName() . ' - ' . $event->exception->getMessage());
        });
    }
}
