<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tool;
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
        $tools = Tool::all()->where('uploader_id', Auth::user()->id)->where('status', 'Actief');
        
        return view('pages.portal', compact('tools'));
    }
}
