<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tool;

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
        $tools = Tool::where('uploader_id', auth()->user()->id)->paginate(5);
        
        return view('pages.portal')->withTools($tools);
    }
}
