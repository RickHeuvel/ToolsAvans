<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;

use Mail;
use App\User;
use App\Mail\ConceptTools;
use App\Tool;

class MailController extends Controller
{
    /*
     * Send mailable to users
     */
    public function sendMailable(Mailable $mailable, $users) {
        Mail::to($users)->send($mailable);

        return view('pages.home');
    }
}
