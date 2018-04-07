<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Redirect;
use Auth;
use Session;
use App\Tool;
use App\ToolReview;

class ReviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a rating
     * 
     * @param $request, $slug
     * contains:
     * int 'rating'
     * 
    */
    public function createRating(Request $request, $slug) {
        if ($request->ajax()) {
            $rules = [
                'rating' => 'required|integer|between:1,5'
            ];

            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                $review = ToolReview::where('tool_slug', $slug)->where('user_id', Auth::id())->first();
                if ($review != null) {
                    $review->rating = $request->input('rating');
                    $review->save();
                } else {
                    $review = ToolReview::create([
                        'tool_slug'     => $slug,
                        'user_id'       => Auth::id(),
                        'rating'        => $request->input('rating')
                    ]);
                }

                return response('Success', 200);
            }
        }
    }

    /**
     * Create a review
     * 
     * @param $request, $slug
     * contains:
     * int 'rating'
     * string 'title'
     * string 'description'
     * 
    */
    public function addReview(Request $request, $slug) {
        $rules = [
            'title' => 'required',
            'description' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('tools/' . $slug)
                ->withErrors($validator)
                ->withInput();
        } else {
            $review = ToolReview::where('tool_slug', $slug)->where('user_id', Auth::id())->firstOrFail();
            $review->title = $request->input('title');
            $review->description = $request->input('description');
            $review->save();

            Session::flash('message', 'Bedankt voor het plaatsen van je review!');
            return back();
        }
    }
}
