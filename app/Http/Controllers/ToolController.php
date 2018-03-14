<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Auth;
use Validator;
use Input;
use Storage;
use Session;
use Redirect;
use File;
use App\ToolCategory;
use App\ToolStatus;
use App\Tool;
use App\ToolImage;
use App\Rules\NameExistsInDatabase;

class ToolController extends Controller
{
    private $itemsPerPage = 10;
    static private $maxImageSize = 1500; // KiloByte

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categories            = ToolCategory::all();
        $selectedCategories    = ($request->has('categories')) ? explode(',', $request->input('categories')) : null;
        $tools                 = ($request->has('categories')) ? Tool::where('status', 'Actief')->whereIn('category_slug', $selectedCategories)->paginate($this->itemsPerPage) : $tools = Tool::where('status', 'Actief')->paginate($this->itemsPerPage);
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
        $categories = ['' => 'Selecteer een categorie...'] + ToolCategory::pluck('name')->all();
        $statuses   = ['' => 'Selecteer een status...'] + ToolStatus::pluck('status')->all();
        return view('pages.tool.create')->with('categories', $categories)->with('statuses', $statuses);
    }

    /**
     * Store a new Tool
     *
     * @param $request
     * contains:
     * string 'name'
     * string 'description'
     * string 'url'
     * file 'logo'
     * string 'status'
     * int 'category'
     * array with files 'images[]'
     * 
     * @return Response
     */
    public function store(Request $request)
    {
        if(!Auth::check())
            return Redirect::to('login');

        $rules = [
            'name'              => 'required|unique:tools|max:255',
            'description'       => 'required',
            'url'               => 'required|url',
            'logo'              => 'required|image|mimes:jpeg,png,jpg,gif|max:1500',
            'status'            => 'required|exists:tool_status,status',
            'category'          => 'required|exists:tool_category,name',
            'images.*'          => 'required|image|mimes:jpeg,png,jpg,gif|max:1500',
            'images'            => 'array|between:2,5',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('tools/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $tool = Tool::create([
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'url'           => $request->input('url'),
                'uploader_id'   => Auth::id(),
                'category_slug' => Str::slug($request->input('category')),
                'status'        => $request->input('status'),
                'logo_filename' => $this->saveImage($request->file('logo'), Str::slug($request->name) . '-logo'),
            ]);

            // Here we create a ToolImage record for every image that has been uploaded, link it to the Tool and save the image to the local disk
            for($i = 0; $i < count($request->file('images')); $i++) 
            {
                ToolImage::create([
                    'tool_slug'         => $tool->slug,
                    'image_filename'    => $this->saveImage($request->file('images')[$i], $tool->slug . '-' . ($i+1)),
                ]);
            }

            Session::flash('message', 'Tool succesvol toegevoegd!');
            return Redirect::to('tools/' . $tool->slug);
        }
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

        $categories = ToolCategory::pluck('name')->all();
        $statuses = ToolStatus::pluck('status')->all();
        $tool = Tool::where('slug', $slug)->firstOrFail();
        return view('pages.tool.edit')->withTool($tool)->with('categories', $categories)->with('statuses', $statuses);
    }

    /**
     * Update a Tool.
     *
     * @param $request
     * contains:
     * string 'name'
     * string 'description'
     * string 'url'
     * file 'logo'
     * string 'status'
     * int 'category'
     * array with files 'images[]'
     * 
     * @param $slug
     * 
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        
        if(!Auth::check())
            return Redirect::to('login');

        $tool = Tool::where('slug', $slug)->firstOrFail();

        $rules = [
            'name'              => ['required','max:255', 
            function($attribute, $value, $fail) use($tool){
                $newslug = Str::slug($value);
                if($tool->slug === $newslug)
                {
                    return true;
                }
                else if(Tool::where('slug', $newslug)->exists())
                {
                    return $fail('Name already exists');
                }
            }],
            'description'       => 'required',
            'url'               => 'required|url',
            'logo'              => 'required|image|mimes:jpeg,png,jpg,gif|max:1500',
            'status'            => 'required|exists:tool_status,status',
            'category'          => 'required|exists:tool_category,name',
            'images.*'          => 'required|image|mimes:jpeg,png,jpg,gif|max:1500',
            'images'            => 'array|between:2,5',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('tools/' . $slug . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $tool->name             = $request->input('name');
            $tool->description      = $request->input('description');
            $tool->url              = $request->input('url');
            $tool->uploader_id      = Auth::id();
            $tool->category_slug    = Str::slug($request->input('category'));
            $tool->status           = $request->input('status');
            $tool->logo_filename    = $this->saveImage($request->file('logo'), Str::slug($request->name) . '-logo');
            $tool->save();

            // Deleting the old
            $toolImages = ToolImage::where('tool_slug', $tool->slug)->get();
            foreach ($toolImages as $toolImage)
            {
               $this->deleteImage($toolImage->image_filename);
            }
            ToolImage::where('tool_slug', $tool->slug)->delete();
            // Here we create a ToolImage record for every image that has been uploaded, link it to the Tool and save the image to the local disk
            for($i = 0; $i < count($request->file('images')); $i++) 
            {
                ToolImage::create([
                    'tool_slug'         => $tool->slug,
                    'image_filename'    => $this->saveImage($request->file('images')[$i], $tool->slug . '-' . ($i+1)),
                ]);
            }

            Session::flash('message', 'Tool succesvol aangepast!');
            return Redirect::to('tools/' . $tool->slug);
        }

    }

    /**
     * Deactivate the specified resource
     *
     * @param  int  $slug
     * @return Response
     */
    public function deactivate($slug)
    {
        if(!Auth::check())
            return Redirect::to('login');

        $tool = Tool::where('slug', $slug)->firstOrFail();
        $tool->status = "Inactief";
        $tool->save();

        Session::flash('message', 'Tool succesvol verwijderd!');
        return Redirect::to('portal');
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


    // Helper functions

    /**
     * Display the specified resource.
     *
     * @param  int  $filename
     * @return Response
     */
    public function getImage($filename)
    {
        $image = Storage::disk('tool-images')->get($filename);
        return new Response($image, 200);
    }

    /**
     * Save a given image to the local disk with a given filename
     * Adds the image extention to the filename before saving
     * 
     * @param UploadedFile $image
     * @return string $filenameWithExtention
     */
    private function saveImage($image, $filename)
    {
        $filenameWithExtention = $filename . '.' . $image->getClientOriginalExtension();
        Storage::disk('tool-images')->put($filenameWithExtention, File::get($image));

        return $filenameWithExtention;
    }

    /**
     * Deletes a given image filename
     * 
     * @param string $imageFilename
     * @return bool $deleted
     */
    private function deleteImage($imageFilename)
    {
        return Storage::disk('tool-images')->delete($imageFilename);
    }
}
