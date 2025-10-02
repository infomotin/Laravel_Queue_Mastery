<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EmailController extends Controller
{
    public function sendEmails(){
        // dd("here");
        $emails = DB::table('emails')->pluck('email');
        // dd($emails);
        foreach ($emails as $email) {
            dispatch(new \App\Jobs\SeedEmail($email));
        }
        return "Emails are being sent!";
    }
}
