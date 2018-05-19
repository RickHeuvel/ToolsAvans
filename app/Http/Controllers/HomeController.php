<?php

namespace App\Http\Controllers;

use App\Tool;
use App\Setting;
use App\ToolTag;
use App\ToolCategory;
use App\Tag;
use Illuminate\Http\Request;

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

        $homepageTag = Setting::has('homepagetag') ? ToolTag::find(Setting::get('homepagetag')->val) : null;
        $homepageCategory = Setting::has('homepagecategory') ? ToolCategory::find(Setting::get('homepagecategory')->val) : null;
        $homepageCategoryTools = $homepageCategory ? Tool::publicTools()->where('category_slug', Setting::get('homepagecategory')->val)->get() : null;
        if ($homepageTag) {
            $homepageTagTools = Tool::publicTools()->whereHas('tags', function ($query) use ($homepageTag) {
                $query->where('slug', $homepageTag->slug);
            })->get();
        } else {
            $homepageTagTools = null;
        }

        return view('pages.home', compact('heroTools', 'newTools', 'popularTools', 'homepageCategoryTools', 'homepageTagTools', 'homepageTag', 'homepageCategory'));
    }
}
