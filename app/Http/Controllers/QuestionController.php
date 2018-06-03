<?php

namespace App\Http\Controllers;

use App\Tool;
use App\User;
use App\ToolQuestion;
use App\ToolQuestionUpvote;
use App\Mail\NewQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class QuestionController extends Controller
{      
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function show($slug)
    {
        $tool = Tool::where('slug', $slug)->firstOrFail();
        $questions = ToolQuestion::where('tool_slug', $slug)->withCount('upvotes')->orderBy('upvotes_count', 'desc')->get();
        
        return view('pages.tool.question', compact('tool', 'questions'));
    }

    /**
     * Store a new question
     * 
     * @param $request, $slug
     * contains:
     * string 'title'
     * string 'text'
     * 
    */
    public function store(Request $request, $slug) {
        $rules = [
            'title' => 'required|max:255',
            'text' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('tools.show', $slug) . '#vragen')->withErrors($validator, 'questions')->withInput();
        } else {
            $question = ToolQuestion::create([
                'tool_slug' => $slug,
                'user_id' => Auth::id(),
                'title' => $request->input('title'),
                'text' => $request->input('text'),
            ]);

            $tool = Tool::find($slug)->firstOrFail();

            $mail = new NewQuestion($question);
            $user = User::findOrFail($tool->owner_id);
            MailController::sendMailable($mail, $user);

            Session::flash('message', 'Je vraag is geplaatst');            
            return redirect(route('tools.show', $slug) . '#vragen');
        }
    }

    /**
     * Upvote the question.
     *
     * @param  int  $id
     * @return Response
     */
    public function upvote(Request $request, $id) {
        if ($request->ajax()) {
            $question = ToolQuestion::find($id);
            if ($question != null) {
                ToolQuestionUpvote::create([
                    'question_id' => $id,
                    'user_id' => Auth::id(),
                    'created_at' => now()
                ]);
                return response()->json([
                    'votes' => $question->upvotes->count()
                ]);
            }

            return response()->json([], 404);
        }
    }
}
