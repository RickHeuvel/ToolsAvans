<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;

use Mail;
use App\User;
use App\Tool;

class MailController extends Controller
{
    /*
     * Send mailable to users
     */
    public static function sendMailable(Mailable $mailable, $users) {
        if(env('MAIL_USERNAME') != null || env('MAIL_PASSWORD') != null)
            Mail::to($users)->send($mailable);

        return null;
    }
}
