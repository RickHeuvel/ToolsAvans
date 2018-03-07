<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Validator;
use Input;
use Storage;
use Session;
use Redirect;
use File;
use App\ToolCategory;
use App\Tool;

class ToolController extends Controller
{
    private $itemsPerPage = 1;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categories =           ToolCategory::all();
        $selectedCategories  =  ($request->has('categories')) ? explode(',', $request->input('categories')) : null;
        $selectedCategoryIds =  ($request->has('categories')) ? ToolCategory::whereIn('slug', $selectedCategories)->pluck('id')->toArray() : null;
        $tools =                ($request->has('categories')) ? Tool::whereIn('category_id', $selectedCategoryIds)->paginate($this->itemsPerPage) : $tools = Tool::paginate($this->itemsPerPage);
        if ($request->ajax()) {
            return view('partials.tools', compact('tools', 'categories', 'selectedCategories'))->render();  
        }

        return view('pages.tools', compact('tools', 'categories', 'selectedCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(!Auth::check())
            return Redirect::to('login');

        return view('pages.tool.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if(!Auth::check())
            return Redirect::to('login');

        $rules = [
            'name'        => 'required|max:255',
            'description' => 'required',
            'url'         => 'required|url',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('tools/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $tool = new Tool;
            $tool->name        = $request->input('name');
            $tool->description = $request->input('description');
            $tool->status      = $request->input('status');
            $tool->url         = $request->input('url');
            $tool->uploader_id = Auth::id();
            $tool->category_id = $request->input('category_id');
            $tool->status      = $request->input('status');

            $thumbnail = $request->input('thumbnail');
            $filename = $tool->slug . '.' . $thumbnail->clientExtension();
            Storage::disk('local')->put($filename, File::get($thumbnail));

            $tool->thumbnail   = $filename;
            $tool->save();

            Session::flash('message', 'Tool succesvol toegevoegd!');
            return Redirect::to('tools/' . $tool->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $filename
     * @return Response
     */
    public function getImage($filename)
    {
        $image = Storage::disk('local')->get($filename);
        return new Response($image, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return Response
     */
    public function show($slug)
    {
        $tool = Tool::where('slug', $slug)->firstOrFail();
        return view('pages.tool.view')->withTool($tool);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slug
     * @return Response
     */
    public function edit($slug)
    {
        if(!Auth::check())
            return Redirect::to('login');

        $tool = Tool::where('slug', $slug)->firstOrFail();
        return view('pages.tool.edit')->withTool($tool);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int     $slug
     * @return Response
     */
    public function update($request, $slug)
    {
        if(!Auth::check())
            return Redirect::to('login');

        $rules = [
            'name'        => 'required|max:255',
            'description' => 'required',
            'url'         => 'required|url',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        $all = $request->all();
        if ($validator->fails()) {
            return Redirect::to('tools/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            Storage::disk('local')->put($filename, File::get($thumbnail));

            $tool = Tool::where('slug', $slug)->firstOrFail();
            $tool->name        = $request->input('name');
            $tool->description = $request->input('description');
            $tool->status      = $request->input('status');
            $tool->url         = $request->input('url');
            $tool->uploader_id = Auth::id();
            $tool->category_id = $request->input('category_id');
            $tool->status      = $request->input('status');
            $tool->thumbnail   = $filename;
            $tool->save();

            Session::flash('message', 'Tool succesvol gewijzigd!');
            return Redirect::to('tools/' . $tool->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slug
     * @return Response
     */
    public function destroy($slug)
    {
        if(!Auth::check())
            return Redirect::to('login');

        $tool = Tool::where('slug', $slug)->firstOrFail();
        $tool->delete();

        Session::flash('message', 'Tool succesvol verwijderd!');
        return Redirect::to('tools');
    }
}
