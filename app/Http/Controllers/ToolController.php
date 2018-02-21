<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ToolController extends Controller
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
     * Show the tools.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tools');
    }
}
