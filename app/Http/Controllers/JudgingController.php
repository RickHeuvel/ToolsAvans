<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Tool;
use App\User;
use Validator;
use App\ToolFeedback;
use App\Mail\ConceptTools;
use Illuminate\Http\Request;
use App\Jobs\SendConceptMail;
use App\Mail\ConceptToolApproved;
use App\Mail\ConceptToolRejected;
use App\Mail\ConceptToolFeedbackReceived;

class JudgingController extends Controller
{
    /**
     * Create a new controller instance
     * Require login and user to have admin role
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'adminrole']);
    }

    /**
     * Approve the specified Tool
     *
     * @param  int  $slug
     * @return Response
     */
    public function approveTool($slug)
    {
        $tool = Tool::where('slug', $slug)->firstOrFail();

        if ($tool->status->isConcept()) {
            $tool->status_slug = 'actief';
            $tool->save();

            if ($tool->feedback != null)
                $tool->feedback->delete();

            $mail = new ConceptToolApproved($tool);
            $user = User::findOrFail($tool->uploader_id);
            MailController::sendMailable($mail, $user);

            Session::flash('message', 'Tool is goedgekeurd!');
        } else {
            Session::flash('message', 'Deze tool kan niet geaccepteerd worden');
        }
        return redirect(route('portal') . '#unjudgedtools');
    }

    /**
     * Disapprove the specified Tool
     *
     * @param  int  $slug
     * @return Response
     */
    public function rejectTool($slug)
    {
        $tool = Tool::where('slug', $slug)->firstOrFail();

        if ($tool->status->isConcept()) {
            $tool->status_slug = 'afgekeurd';
            $tool->save();

            if ($tool->feedback != null)
                $tool->feedback->delete();

            $mail = new ConceptToolRejected($tool);
            $user = User::findOrFail($tool->uploader_id);
            MailController::sendMailable($mail, $user);

            Session::flash('message', 'Tool is succesvol afgekeurd');
        } else {
            Session::flash('message', 'Deze tool kan niet afgekeurd worden');
        }
        return redirect(route('portal') . '#unjudgedtools');
    }

    /**
     * Store a ToolFeedback for the specified Tool
     *
     * @param  \Illuminate\Http\Request  $request
     * This Request includes:
     * string feedback
     * @param  string  $toolSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function requestToolChanges(Request $request, $slug)
    {
        $rules = [
            'feedback' => 'max:1000'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('portal') . '#unjudgedtools')->withErrors($validator)->withInput();
        } else {
            $tool = Tool::where('slug', $slug)->firstOrFail();
            if ($tool->feedback != null)
                $tool->feedback->delete();

            ToolFeedback::create([
                'tool_slug' => $slug,
                'feedback'  => $request->input('feedback'),
            ]);

            $mail = new ConceptToolFeedbackReceived($tool);
            $user = User::findOrFail($tool->uploader_id);
            MailController::sendMailable($mail, $user);

            Session::flash('message', 'Feedback successvol opgestuurd.');
            return redirect(route('portal') . '#unjudgedtools');
        }
    }

    /**
     * DO some shit
     *
     */
    public function sendmail(Request $request) {
        Artisan::call('conceptmail:send');

        return redirect()->route('portal');
    }
}
