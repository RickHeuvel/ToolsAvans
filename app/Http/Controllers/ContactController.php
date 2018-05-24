<?php

namespace App\Http\Controllers;

use Auth;
use App\Tool;
use App\User;
use App\Setting;
use App\ToolStatus;
use App\ToolView;
use App\ToolReview;
use App\ToolCategory;
use App\Tag;
use App\ToolTag;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Show the application portal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return view('pages.contact');
    }

    public function sendQuestion(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'question' => 'required'
        ]);

        $mail = new Contact($request->all());
        $users = User::admins()->get();
        MailController::sendMailable($mail, $users);

        Session::flash('message','Je vraag is succesvol opgestuurd');
        return redirect()->route('contact.index');
    }
}
