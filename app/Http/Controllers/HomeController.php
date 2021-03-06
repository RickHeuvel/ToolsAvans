<?php

namespace App\Http\Controllers;

use App\Tool;
use App\Setting;
use App\ToolTag;
use App\ToolCategory;
use App\Tag;
use Illuminate\Http\Request;
use Event;
use App\Events\ViewPage;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heroTools = Tool::publicTools()->withCount('views')->orderBy('views_count', 'desc')->limit(3)->get()->shuffle();
        $newTools = Tool::publicTools()->orderBy('created_at', 'desc')->limit(3)->get();
        $popularTools = Tool::publicTools()->where('created_at','>', date('y-m-d', strtotime('-1 month')))->withCount('views')->orderBy('views_count', 'desc')->limit(3)->get();

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

        $categories = ToolCategory::inRandomOrder()->limit(4)->get()->shuffle();

        Event::fire(new ViewPage('home'));
        return view('pages.home', compact('heroTools', 'newTools', 'popularTools', 'homepageCategoryTools', 'homepageTagTools', 'homepageTag', 'homepageCategory', 'categories'));
    }
}
