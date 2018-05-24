<?php

namespace App\Http\Controllers;

use App\Tool;
use App\User;
use App\ToolAnswer;
use App\ToolAnswerUpvote;
use App\ToolQuestion;
use App\Mail\NewAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class AnswerController extends Controller
{     
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new answer
     * 
     * @param $request, $slug
     * contains:
     * string 'text'
     * 
    */
    public function store(Request $request, $slug, $question){
        $rules = [
            'text' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect(route('tools.show', $slug) . '#vragen')->withErrors($validator, 'answers')->withInput();
        } else {
            $answer = ToolAnswer::create([
                'question_id' => $question,
                'user_id' => Auth::id(),
                'text' => $request->input('text'),
            ]);

            $tool = Tool::find($slug)->firstOrFail();
            $question = ToolQuestion::find($question);

            $mail = new NewAnswer($answer,$tool);
            $user = User::findOrFail($question->user_id);
            MailController::sendMailable($mail, $user);

            Session::flash('message', 'Je reactie is geplaatst');            
            return redirect(route('tools.show', $slug) . '#vragen');
        }
    }

    /**
     * Upvote the answer.
     *
     * @param  int  $id
     * @return Response
     */
    public function upvote(Request $request, $id) {
        if ($request->ajax()) {
            $answer = ToolAnswer::find($id);
            if ($answer != null) {
                ToolAnswerUpvote::create([
                    'answer_id' => $id,
                    'user_id' => Auth::id(),
                    'created_at' => now()
                ]);
                return response()->json([
                    'votes' => $answer->upvotes->count()
                ]);
            }

            return response()->json([], 404);
        }
    }
}
