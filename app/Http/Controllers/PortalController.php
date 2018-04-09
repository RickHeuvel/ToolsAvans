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
        $myTools = Tool::where('uploader_id', Auth::user()->id)->where('status_slug', 'actief')->orderBy('slug')->paginate(10);
        if (Auth::user()->isAdmin()) {
            $categories = ToolCategory::all()->sortBy('slug');
            $categoryGroups = Tool::all()->groupBy('category_slug');
            $tools = Tool::all()->sortBy('slug');
            $specifications = Specification::all()->sortBy('slug');
            $specificationGroups = ToolSpecification::all();
            $activeTools = Tool::activeTools()->orderBy('slug')->paginate(10);
            $inactiveTools = Tool::inactiveTools()->orderBy('slug')->paginate(10);
            $unjudgedTools = Tool::unjudgedTools()->orderBy('created_at')->paginate(10);
            $conceptTools = Tool::conceptTools()->paginate(10);
            $rejectedTools = Tool::rejectedTools()->paginate(10);

            return view('pages.portal', compact('myTools', 'categories', 'categoryGroups', 'activeTools', 'inactiveTools', 'unjudgedTools', 'conceptTools', 'rejectedTools', 'tools', 'specifications', 'specificationGroups'));
        } else {
            $myConceptTools = Tool::conceptTools()->where('uploader_id', Auth::user()->id)->orderBy('slug')->paginate(10);

            return view('pages.portal', compact('myTools', 'myConceptTools'));
        }
    }
}
