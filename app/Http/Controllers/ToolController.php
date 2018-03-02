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
        $this->middleware('auth');
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
        return view('pages.tool.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'        => 'required|max:255',
            'description' => 'required',
            'url'         => 'required|url',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:255',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('tools/create')->withErrors($validator);
        } else {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            Storage::disk('local')->put($filename, File::get($thumbnail));

            $tool = new Tool;
            $tool->name        = Input::get('name');
            $tool->description = Input::get('description');
            $tool->category    = 'webservice';
            $tool->status      = 'active';
            $tool->url         = Input::get('url');
            $tool->uploader_id = Auth::user()->id;
            $tool->thumbnail   = $filename;
            $tool->save();

            Session::flash('message', 'Tool succesvol toegevoegd!');
            return Redirect::to('tools');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $tool = Tool::find($id);
        return view('pages.tool.view', [
            "tool" => $tool
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
