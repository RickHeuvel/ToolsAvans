<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tool;
use App\User;
use App\ToolCategory;
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
            $users = User::all();
            $categories = ToolCategory::all()->sortBy('slug');
            $categoryGroups = Tool::all()->groupBy('category_slug');
            $tools = Tool::all()->sortBy('slug');

            return view('pages.portal', compact('myTools', 'categories', 'categoryGroups', 'users', 'tools'));
        }
        
        return view('pages.portal', compact('myTools'));
    }
}
