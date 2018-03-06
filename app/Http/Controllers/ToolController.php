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
use App\Tool;

class ToolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tools = Tool::all();
        return view('pages.tools', [
            "tools" => $tools
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->middleware('auth');

        return view('pages.tool.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');

        $rules = [
            'name'        => 'required|max:255',
            'description' => 'required',
            'url'         => 'required|url',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:255',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('tools/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            Storage::disk('local')->put($filename, File::get($thumbnail));

            $tool = new Tool;
            $tool->name        = $request->input('name');
            $tool->description = $request->input('description');
            $tool->category    = $request->input('category');
            $tool->status      = $request->input('status');
            $tool->url         = $request->input('url');
            $tool->uploader_id = $request->input('uploader_id');
            $tool->category    = $request->input('category');
            $tool->status      = $request->input('status');
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
        $this->middleware('auth');

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
        $this->middleware('auth');

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
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            Storage::disk('local')->put($filename, File::get($thumbnail));

            $tool = Tool::where('slug', $slug)->firstOrFail();
            $tool->name        = $request->input('name');
            $tool->description = $request->input('description');
            $tool->category    = $request->input('category');
            $tool->status      = $request->input('status');
            $tool->url         = $request->input('url');
            $tool->uploader_id = $request->input('uploader_id');
            $tool->category    = $request->input('category');
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
        $this->middleware('auth');

        $tool = Tool::where('slug', $slug)->firstOrFail();
        $tool->delete();

        Session::flash('message', 'Tool succesvol verwijderd!');
        return Redirect::to('tools');
    }
}
