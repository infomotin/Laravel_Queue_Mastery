<?php

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

// Route::get('/send-emails', [EmailController::class, 'sendEmails']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // foreach (range(1, 100) as $i) {
    //     echo $i . ' ';
    //     \App\Jobs\SendWelcomeEmail::dispatch();
    // }

    // \App\Jobs\SendWelcomeEmail::dispatch();
    // \App\Jobs\ProcessPayment::dispatch()->onQueue('payments');
    // \App\Jobs\SeedEmail::dispatch();
    // $batch = [
    //     // new \App\Jobs\SendWelcomeEmail('email1'),
    //     // new \App\Jobs\SendWelcomeEmail('email2'),
    //     // new \App\Jobs\SendWelcomeEmail('email3'),

    //     // new \App\Jobs\SeedEmail(),
    //     // new \App\Jobs\ProcessPayment(),
    //     [
    //         new \App\Jobs\ProcessPayment('payment1'),
    //         new \App\Jobs\SeedEmail('payment2'),
    //         new \App\Jobs\SendWelcomeEmail('payment3'),
    //     ],
    //     [
    //         new \App\Jobs\ProcessPayment('payment1'),
    //         new \App\Jobs\SeedEmail('payment2'),
    //         new \App\Jobs\SendWelcomeEmail('payment3'),
    //     ]

    // ];
    // \Illuminate\Support\Facades\Bus::batch($batch)
    //     ->allowFailures(true) // allow failures for individual jobs
    //     // ->then(function (\Illuminate\Bus\Batch $batch) {
    //     //     // All jobs completed successfully...
    //     //     info('All jobs completed successfully...');
    //     // })
    //     // ->catch(function (\Illuminate\Bus\Batch $batch, \Throwable $e) {
    //     //     // First batch job failure detected...
    //     //     info('First batch job failure detected...');
    //     // })
    //     // ->onQueue('processing') // specify the queue for the batch
    //     // ->onConnection('database') // specify the connection for the batch
    //     // ->finally(function (\Illuminate\Bus\Batch $batch) {
    //     //     // The batch has finished executing...
    //     //     info('The batch has finished executing...');
    //     // })
    //     ->dispatch();

    Bus::chain([
        new \App\Jobs\ProcessPayment(),
        // new \App\Jobs\SeedEmail(),
        // new \App\Jobs\SendWelcomeEmail(),
        function () {
            Bus::batch([
                new \App\Jobs\SeedEmail(),
                new \App\Jobs\SendWelcomeEmail(),
            ])->then(function (\Illuminate\Bus\Batch $batch) {
                // All jobs completed successfully...
                info('All jobs completed successfully...');
            })->catch(function (\Illuminate\Bus\Batch $batch, \Throwable $e) {
                // First batch job failure detected...
                info('First batch job failure detected...');
            })->finally(function (\Illuminate\Bus\Batch $batch) {
                // The batch has finished executing...
                info('The batch has finished executing...');
            })->allowFailures(true)->dispatch();
        },
        function () {
            Bus::batch([
                new \App\Jobs\ProcessPayment(),
                new \App\Jobs\SendWelcomeEmail(),
            ])->dispatch();
        }
    ]);


    return view('welcome');
});
