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
use Route;
use App\ToolCategory;
use App\ToolStatus;
use App\Tool;
use App\ToolImage;
use App\Rules\NameExistsInDatabase;

class ToolController extends Controller
{
    private $itemsPerPage = 10;
    private $maxImageSize = 1500; // KiloByte
    private $publicActions = ['index', 'show', 'getImage'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Route::getCurrentRoute() != null && !in_array(Route::getCurrentRoute()->getActionMethod(), $this->publicActions))
            $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categories            = ToolCategory::all();
        $selectedCategories    = ($request->has('categories')) ? explode(',', $request->input('categories')) : null;
        $tools                 = ($request->has('categories')) ? Tool::where('status_slug', 'actief')->whereIn('category_slug', $selectedCategories)->paginate($this->itemsPerPage) : $tools = Tool::where('status_slug', 'actief')->paginate($this->itemsPerPage);
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
        $categories = ['' => 'Selecteer een categorie...'] + ToolCategory::pluck('name')->all();
        $statuses   = ['' => 'Selecteer een status...'] + ToolStatus::pluck('name')->all();
        return view('pages.tool.create', compact('categories', 'statuses'));
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
        $rules = [
            'name'              => 'required|unique:tools|max:255',
            'description'       => 'required',
            'url'               => 'required|url',
            'logo'              => 'required|image|mimes:jpeg,png,jpg,gif|max:1500',
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
                'status_slug'   => (Auth::user()->isAdmin() || Auth::user()->isEmployee()) ? "actief" : "concept",
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
        return view('pages.tool.view', compact('tool'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slug
     * @return Response
     */
    public function edit($slug)
    {
        $categories = ToolCategory::pluck('name')->all();
        $statuses = ToolStatus::pluck('name')->all();
        $tool = Tool::where('slug', $slug)->firstOrFail();
        return view('pages.tool.edit', compact('tool', 'categories', 'statuses'));
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
     * Activate the specified resource
     *
     * @param  int  $slug
     * @return Response
     */
    public function activate($slug)
    {
        $tool = Tool::where('slug', $slug)->firstOrFail();
        $tool->status_slug = "actief";
        $tool->save();

        Session::flash('message', 'Tool succesvol teruggezet!');
        return Redirect::to('portal');
    }

    /**
     * Approve the specified resource
     *
     * @param  int  $slug
     * @return Response
     */
    public function approve($slug)
    {
        $tool = Tool::where('slug', $slug)->firstOrFail();
        $tool->status_slug = "actief";
        $tool->save();

        Session::flash('message', 'Tool is goedgekeurd!');
        return Redirect::to('portal');
    }

    /**
     * Deactivate the specified resource
     *
     * @param  int  $slug
     * @return Response
     */
    public function deactivate($slug)
    {
        $tool = Tool::where('slug', $slug)->firstOrFail();
        $tool->status_slug = "inactief";
        $tool->save();

        Session::flash('message', 'Tool succesvol verwijderd!');
        return Redirect::to('portal');
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
