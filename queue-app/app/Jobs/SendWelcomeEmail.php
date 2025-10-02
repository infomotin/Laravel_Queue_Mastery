<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    // public $timeout = 1;
    // public $tries = -1; // Unlimited tries
    // public $backoff = [10, 30, 60]; // in seconds
    // public $backoff = 2; // in seconds

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        sleep(3); // Simulate a time-consuming task
        info('Welcome email sent!');
    }

    // public function failed(\Throwable $exception)
    // {
    //     // Send user notification of failure, etc...
    //     info('The job failed with exception: ' . $exception->getMessage());
    // }

    //retryUntil
    // public function retryUntil()
    // {
    //     return now()->addSeconds(60);
    // }
}
