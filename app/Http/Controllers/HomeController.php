<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tool;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heroTools = Tool::activeTools()->withCount('views')->orderBy('views_count', 'desc')->limit(5)->get()->shuffle();
        $newTools = Tool::activeTools()->orderBy('created_at', 'desc')->limit(5)->get();
        $popularTools = Tool::activeTools()->withCount('views')->orderBy('views_count', 'desc')->limit(5)->get();
        return view('pages.home', compact('heroTools', 'newTools', 'popularTools'));
    }
}
