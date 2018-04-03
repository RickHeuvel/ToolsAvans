<?php

namespace App\Http\Controllers;

use App\Tool;
use App\ToolFeedback;
use App\User;
use Session;
use Redirect;
use Auth;
use Validator;
use Illuminate\Http\Request;

class JudgingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // if (!Auth::user()->isAdmin()) {
        //     Session::flash('message', 'Administrator rechten vereist');
        //     Redirect::to(route('portal'));
        // }
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

        if ($tool->status_slug == 'concept') {
            $tool->status_slug = 'actief';
            $tool->save();

            if ($tool->feedback != null)
                $tool->feedback->delete();

            Session::flash('message', 'Tool is goedgekeurd!');
            return Redirect::to(route('portal') . '#judgetools');
        } else {
            Session::flash('message', 'Deze tool kan niet geaccepteerd worden');
            return Redirect::to(route('portal') . '#judgetools');
        }
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

        if ($tool->status_slug == 'concept') {
            $tool->status_slug = 'afgekeurd';
            $tool->save();

            if ($tool->feedback != null)
                $tool->feedback->delete();

            Session::flash('message', 'Tool is succesvol afgekeurd');
            return Redirect::to(route('portal') . '#judgetools');
        } else {
            Session::flash('message', 'Deze tool kan niet afgekeurd worden');
            return Redirect::to(route('portal') . '#judgetools');
        }
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
            return Redirect::to(route('portal') . '#judgetools')
                ->withErrors($validator)
                ->withInput();
        } else {
            $tool = Tool::where('slug', $slug)->firstOrFail();
            if ($tool->feedback != null)
                $tool->feedback->delete();

            ToolFeedback::create([
                'tool_slug'     => $slug,
                'feedback'      => $request->input('feedback'),
            ]);

            Session::flash('message', 'Feedback successvol opgestuurd.');
            return Redirect::to(route('portal') . '#judgetools');
        }
    }
}
