<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tool;
use App\User;
use App\ToolCategory;
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
    public function index()
    {
        $myTools = Tool::where('uploader_id', Auth::user()->id)->where('status_slug', 'actief')->orderBy('slug')->get();
        if (Auth::user()->isAdmin()) {
            $categories = ToolCategory::all()->sortBy('slug');
            $categoryGroups = Tool::all()->groupBy('category_slug');
            $tools = Tool::all()->sortBy('slug');
            $specifications = Specification::all()->sortBy('slug');
            $specificationGroups = ToolSpecification::all();
            $activeTools = Tool::activeTools()->orderBy('slug')->get();
            $inactiveTools = Tool::inactiveTools()->orderBy('slug')->get();
            $unjudgedTools = Tool::unjudgedTools()->orderBy('created_at')->get();
            $conceptTools = Tool::conceptTools()->get();
            $rejectedTools = Tool::rejectedTools()->get();

            return view('pages.portal', compact('myTools', 'categories', 'categoryGroups', 'activeTools', 'inactiveTools', 'unjudgedTools', 'conceptTools', 'rejectedTools', 'tools', 'specifications', 'specificationGroups'));
        } else {
            $myConceptTools = Tool::conceptTools()->where('uploader_id', Auth::user()->id)->orderBy('slug')->get();

            return view('pages.portal', compact('myTools', 'myConceptTools'));
        }
    }
}
