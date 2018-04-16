<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tool;
use App\User;
use App\ToolCategory;
use App\ToolStatus;
use App\Specification;
use App\ToolSpecification;
use Auth;

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
        $myTools = Tool::activeTools()->where('uploader_id', Auth::user()->id)->orderBy('slug')->get();
        if (Auth::user()->isAdmin()) {
            $categories = ToolCategory::all()->sortBy('slug');
            $categoryGroups = Tool::all()->groupBy('category_slug');
            $specifications = Specification::all()->sortBy('slug');
            $specificationGroups = ToolSpecification::all();

            $statuses = ToolStatus::all();
            if ($request->has('statuses'))
                $selectedStatuses = explode(',', $request->input('statuses'));

            if ($request->has('statuses'))
                $tools = Tool::whereIn('status_slug', $selectedStatuses)->paginate($this->itemsPerPage);
            else
                $tools = Tool::paginate($this->itemsPerPage);

            $unjudgedTools = Tool::unjudgedTools()->get();
            if ($request->ajax())
                return view('partials.tools', compact('tools', 'statuses', 'selectedStatuses'))->render();  
            else
                return view('pages.portal', compact('myTools', 'categories', 'categoryGroups', 'tools', 'unjudgedTools', 'statuses', 'selectedStatuses', 'specifications', 'specificationGroups'));
        } else {
            $myConceptTools = $myTools->where('status_slug', 'active');

            return view('pages.portal', compact('myTools', 'myConceptTools'));
        }
    }
}
