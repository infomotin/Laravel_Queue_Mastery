<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SeedEmail implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    // public $tries = 2;
    // public $maxExceptions = 2;

    // public $backoff = [2,10,30,40];
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        throw new \Exception('Seed email failed');
        sleep(1);
        // return $this->release();
        info('Seed email sent!');

    }
    // public
    function failed(\Throwable $exception)
    {
        info('Seed email job failed after max attempts. Exception: ' . $exception->getMessage());
    }
}
