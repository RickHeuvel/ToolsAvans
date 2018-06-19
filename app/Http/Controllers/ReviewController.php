<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Tool;
use Validator;
use App\ToolReview;
use App\ToolTeacherReview;
use App\ToolReviewNegative;
use App\ToolReviewPositive;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
                'rating' => 'nullable|integer|between:1,5'
            ];

            $validator = Validator::make($request->all(), $rules);
            if (!$validator->fails()) {
                if ($request->has('rating')) {
                    $review = (Auth::user()->isEmployee()) ? ToolTeacherReview::where('tool_slug', $slug)->where('user_id', Auth::id())->first() : ToolReview::where('tool_slug', $slug)->where('user_id', Auth::id())->first();
                    if ($review != null) {
                        $review->rating = $request->input('rating');
                        $review->save();
                    } else {
                        if (Auth::user()->isEmployee()) {
                            $review = ToolTeacherReview::create([
                                'tool_slug' => $slug,
                                'user_id'   => Auth::id(),
                                'rating'    => $request->input('rating')
                            ]);
                        } else {
                            $review = ToolReview::create([
                                'tool_slug' => $slug,
                                'user_id'   => Auth::id(),
                                'rating'    => $request->input('rating')
                            ]);
                        }
                    }
                }

                $tool = Tool::where('slug', $slug)->firstOrFail();
                $userReview = (Auth::check()) ? 
                        (Auth::user()->isEmployee()) ? 
                            $tool->teacherReviews->where('user_id', Auth::id())->first() : 
                            $tool->reviews->where('user_id', Auth::id())->first() : null;

                if ($request->has('multiple')) {
                    return view('partials.stars-multiple', compact('tool', 'userReview'));
                }
                return view('partials.stars-single', compact('tool', 'userReview'));
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
    public function storeReview(Request $request, $slug) {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('tools.show', $slug)->withErrors($validator)->withInput();
        } else {
            $review = ToolReview::where('tool_slug', $slug)->where('user_id', Auth::id())->firstOrFail();
            $review->title = $request->input('title');
            $review->description = $request->input('description');
            $review->save();

            Session::flash('message', 'Bedankt voor het plaatsen van je review!');
            return redirect(route('tools.show', $slug) . '#reviews');
        }
    }

    public function createTeacherReview($slug) {
        $tool = Tool::where('slug', $slug)->firstOrFail();
        return view('pages.teacher-review.create', compact('tool'));
    }

    public function editTeacherReview($slug) {
        $tool = Tool::where('slug', $slug)->firstOrFail();
        $teacherReview = ToolTeacherReview::where('tool_slug', $slug)->where('user_id', Auth::id())->firstOrFail();
        return view('pages.teacher-review.edit', compact('teacherReview', 'tool'));
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
    public function storeTeacherReview(Request $request, $slug) {
        $rules = [
            'title' => 'required|string',
            'preview' => 'required|string',
            'description' => 'required|string',
            'positives' => 'nullable|array',
            'negatives' => 'nullable|array'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('tools.teacherreview.create', $slug)->withErrors($validator)->withInput();
        } else {
            $review = ToolTeacherReview::where('tool_slug', $slug)->where('user_id', Auth::id())->firstOrFail();
            $review->title = $request->input('title');
            $review->preview = $request->input('preview');
            $review->recommended = $request->has('recommended');
            $review->description = $request->input('description');
            $review->save();

            $positives = ToolReviewPositive::where('teacher_review_id', $review->id)->delete();
            if ($request->has('positives')) {
                foreach($request->input('positives') as $positive) {
                    ToolReviewPositive::create([
                        'teacher_review_id' => $review->id,
                        'title' => $positive
                    ]);
                }
            }

            $negatives = ToolReviewNegative::where('teacher_review_id', $review->id)->delete();
            if ($request->has('negatives')) {
                foreach($request->input('negatives') as $negative) {
                    ToolReviewNegative::create([
                        'teacher_review_id' => $review->id,
                        'title' => $negative
                    ]);
                }
            }
            
            Session::flash('message', 'Bedankt voor het plaatsen van je review!');
            return redirect(route('tools.show', $slug) . '#reviews');
        }
    }
      
    /**
     * Remove the specified resource
     *
     * @param  int  $slug
     * @return Response
     */
    public function destroy($id)
    {
        $review = ToolReview::findOrFail($id);
        $review->delete();

        Session::flash('message', 'Review succesvol verwijderd!');
        return redirect(route('tools.show', $review->tool_slug) . '#reviews');
    }
}
