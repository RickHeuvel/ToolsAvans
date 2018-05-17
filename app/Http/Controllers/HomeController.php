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
        $heroTools = Tool::publicTools()->withCount('views')->orderBy('views_count', 'desc')->limit(5)->get()->shuffle();
        $newTools = Tool::publicTools()->orderBy('created_at', 'desc')->limit(5)->get();
        $popularTools = Tool::publicTools()->withCount('views')->orderBy('views_count', 'desc')->limit(5)->get();
        return view('pages.home', compact('heroTools', 'newTools', 'popularTools'));
    }
}
