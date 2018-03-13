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
use App\Tool;
use App\ToolImage;

class ToolController extends Controller
{
    private $itemsPerPage = 1;

    // CRUD functions

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
     * 
     * The backend is able to handle as many images as the user wants, but I'd say cap it at 5
     * file 'image-1'
     * file 'image-2'
     * etc. etc....
     * 
     * @return Response
     */
    public function store(Request $request)
    {
        if(!Auth::check())
            return Redirect::to('login');

            $uploadedImages = $request->allFiles();

            $rules = [
                'name'              => 'required|max:255',
                'description'       => 'required',
                'url'               => 'required|url',
                'logo'              => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:255',
                'status'            => 'required|exists:tool_status,status',
                'category'          => 'required|exists:tool_category,name',
                'uploadedImages'    => 'array|between:2,5',
            ];
            // Here we add a validation rule to the ruleset for every image that has been uploaded
            for($i = 1; $i < count($uploadedImages); $i++) 
            {
                $imageRule = [
                    'image' . '-' . $i => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:255',
                ];
                $rules = array_merge($rules, $imageRule);
            }
            
            // Creating an array with elements for the validation to check
            // Contains all the input that is in the $request and the $uploadedImages
            $elementsToValidate = array_merge($request->all(), [ 'uploadedImages' => $uploadedImages ]);
            $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('tools/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $logo = $request->file('logo');

            $tool = Tool::create([
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'url'           => $request->input('url'),
                'uploader_id'   => Auth::id(),
                'category_slug' => Str::slug($request->input('category')),
                'status'        => $request->input('status'),
                'logo_filename' => $this->saveImage($logo, Str::slug($request->name) . '-logo'),
            ]);

            // Here we create a ToolImage record for every image that has been uploaded, link it to the Tool and save the image to the local disk
            for($i = 1; $i < count($uploadedImages); $i++) 
            {
                ToolImage::create([
                    'tool_slug'         => $tool->slug,
                    'image_filename'    => $this->saveImage($uploadedImages['image-' . $i], $tool->slug . '-' . $i),
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

        $tool = Tool::where('slug', $slug)->firstOrFail();
        return view('pages.tool.edit')->withTool($tool);
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
     * 
     * The backend is able to handle as many images as the user wants, but I'd say cap it at 5
     * file 'image-1'
     * file 'image-2'
     * etc. etc....
     * 
     * @param $slug
     * 
     * @return Response
     */
    public function update($request, $slug)
    {
        if(!Auth::check())
            return Redirect::to('login');

        $uploadedImages = $request->allFiles();

        $rules = [
            'name'              => 'required|max:255',
            'description'       => 'required',
            'url'               => 'required|url',
            'logo'              => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:255',
            'status'            => 'required|exists:tool_status,status',
            'category'          => 'required|exists:tool_category,name',
            'uploadedImages'    => 'array|between:2,5',
        ];
        // Here we add a validation rule to the ruleset for every image that has been uploaded
        for($i = 1; $i < count($uploadedImages); $i++) 
        {
            $imageRule = [
                'image' . '-' . $i => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:255',
            ];
            $rules = array_merge($rules, $imageRule);
        }
        
        // Creating an array with elements for the validation to check
        // Contains all the input that is in the $request and the $uploadedImages
        $elementsToValidate = array_merge($request->all(), [ 'uploadedImages' => $uploadedImages ]);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('tools/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $logo = $request->file('logo');

            $tool = Tool::where('slug', $slug)->firstOrFail();
            $tool->name             = $request->input('name');
            $tool->description      = $request->input('description');
            $tool->url              = $request->input('url');
            $tool->uploader_id      = Auth::id();
            $tool->category_slug    = Str::slug($request->input('category'));
            $tool->status           = $request->input('status');
            $tool->logo_filename    = $this->saveImage($logo, Str::slug($request->name) . '-logo');
            $tool->save();

            // Deleting the old
            $toolImages = ToolImage::where('tool_slug', $tool->slug)->get();
            foreach ($toolImages as $toolImage)
            {
               $this->deleteImage($toolImage->image_filename);
            }
            ToolImage::where('tool_slug', $tool->slug)->delete();
            // Here we create a ToolImage record for every image that has been uploaded, link it to the Tool and save the image to the local disk
            for($i = 1; $i < count($uploadedImages); $i++) 
            {
                ToolImage::create([
                    'tool_slug'         => $tool->slug,
                    'image_filename'    => $this->saveImage($uploadedImages['image-' . $i], $tool->slug . '-' . $i),
                ]);
            }

            Session::flash('message', 'Tool succesvol toegevoegd!');
            return Redirect::to('tools/' . $tool->slug);
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
