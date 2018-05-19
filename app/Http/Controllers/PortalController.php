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
use App\TagCategory;
use App\ToolTag;
use Illuminate\Http\Request;

class PortalController extends Controller
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
     * Show the application portal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $myTools = Tool::publicTools()->where('uploader_id', Auth::user()->id)->orderBy('slug')->get();
        if (Auth::user()->isAdmin()) {
            $statuses = ToolStatus::all();
            if ($request->has('statuses'))
                $selectedStatuses = explode(',', $request->input('statuses'));

            $allTools = Tool::all();
            if ($request->has('statuses'))
                $tools = Tool::whereIn('status_slug', $selectedStatuses)->paginate($this->itemsPerPage);
            else
                $tools = Tool::paginate($this->itemsPerPage);

            // Returning now to increase performance
            if ($request->ajax())
                return view('partials.tools', compact('tools'))->render();

            $categories = ToolCategory::all()->sortBy('slug');
            $categoryGroups = Tool::all()->groupBy('category_slug');
            $tags = ToolTag::all()->sortBy('slug');
            $tagGroups = ToolTag::usedTags()->get()->sortBy('slug');
            $tagCategories = TagCategory::all()->sortBy('slug');
            $tagCategoryGroups = ToolTag::all()->groupBy('category_slug');
            $users = User::all();
            $settings = new Setting();
            $unjudgedTools = Tool::unjudgedTools()->get();

            return view('pages.portal', compact('myTools', 'categories', 'categoryGroups', 'tools', 'unjudgedTools', 'users',
                'settings', 'statuses', 'selectedStatuses', 'tags', 'tagGroups', 'tagCategories', 'tagCategoryGroups', 'allTools'));
        } else {
            $myConceptTools = $myTools->where('status_slug', 'active');

            return view('pages.portal', compact('myTools', 'myConceptTools'));
        }
    }
}
