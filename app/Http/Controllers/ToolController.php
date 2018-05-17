<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Event;
use Input;
use Route;
use Session;
use Storage;
use App\Tool;
use Validator;
use App\ToolImage;
use App\SortOption;
use App\ToolReview;
use App\ToolStatus;
use App\ToolCategory;
use App\ToolQuestion;
use App\ToolAnswer;
use App\ToolView;
use App\TagCategory;
use App\Events\ViewTool;
use App\ToolTag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Rules\ToolDoesNotExist;
use App\Rules\ToolOnlyOnceInList;
use App\Rules\NameExistsInDatabase;
use App\Rules\ImageExistsOnDisk;

class ToolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'getImage']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = ToolCategory::all();
        $selectedCategories = ($request->has('categories')) ? explode('+', $request->input('categories')) : null;

        $allTags = ToolTag::usedTags();
        $pinnedTags = ToolTag::usedTags()->where('pinned', true)->get();
        $tagCategories = TagCategory::all();
        $tagsWithoutCategory = ToolTag::usedTags()->doesntHave('category')->get();
        $selectedTags = ($request->has('tags')) ? explode('+', $request->input('tags')) : null;

        $sortOptions = SortOption::all();
        $selectedSortOptions = ($request->has('sort') && count(explode('-', $request->input('sort'))) > 1) ? 
            $request->input('sort') : implode('-', ['views_count', 'desc']);

        $sortType = explode('-', $selectedSortOptions)[0];
        $sortDirection = explode('-', $selectedSortOptions)[1];
        $sortOptions->where('type', $sortType)->where('direction', $sortDirection)->first()->active = true;

        $tools = Tool::activeTools();

        if ($request->has('categories')){
            $tools = $tools->whereIn('category_slug', $selectedCategories);
        }
        if($request->has('tags')){
            $tools = $tools->whereHas('tags', function ($query) use ($selectedTags) {
                // $query is now in tags
                $query->whereIn('slug', $selectedTags);
            });
        }

        $tools = $tools->withCount('views');

        $searchColumns = [
            'name'            => 10,
            'slug'            => 9,
            'description'     => 3,
            'category_slug'   => 7,
            'category.name'   => 8,
            'tags.slug'   => 7,
            'tags.name'   => 8,
            'user.nickname'   => 4,
        ];
        if ($request->has('searchQuery')) {
                $tools = $tools->search('*' . $request->input('searchQuery') . '*', $searchColumns, true);
        }

        // Filter on sorting type, and paginate
        $tools = $tools->orderBy($sortType, $sortDirection)->paginate($this->itemsPerPage);

        if ($request->ajax())
            return response()->json([
                'tools' => view('partials.tools', compact('tools', 'categories', 'selectedCategories', 'allTags',
                'pinnedTags', 'tagCategories', 'tagsWithoutCategory', 'selectedTags', 'selectedSortOptions'))->render(),
                'sorting' => view('partials.sorting', compact('selectedSortOptions', 'sortOptions'))->render()
            ]);
        else
            return view('pages.tools', compact('tools', 'categories', 'selectedCategories', 'allTags', 'pinnedTags',
                'tagCategories', 'tagsWithoutCategory', 'selectedTags', 'selectedSortOptions', 'sortOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tags = ToolTag::all();
        $categories = ToolCategory::pluck('name', 'slug');
        return view('pages.tool.create', compact('categories', 'tags'));
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
     * encoded json string containing uploaded image filenames
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // Converting the images string with the filenames to an array and insert it into the request for validation
        $images = json_decode($request->input('images'));
        $thingsToValidate = array_merge($request->all(), ['images' => $images]);

        $rules = [
            'name'              => 'required|unique:tools|max:255',
            'description'       => 'required',
            'url'               => 'required|url',
            'logo'              => ['required', new ImageExistsOnDisk],
            'category'          => 'required|exists:tool_category,slug',
            'images'            => 'array|between:2,8',
            'images.*'          => [new ImageExistsOnDisk],
            'tags'              => new ToolOnlyOnceInList($request->input('tags')),

        ];

        $validator = Validator::make($thingsToValidate, $rules);
        if ($validator->fails()) {
            return redirect()->route('tools.create')->withErrors($validator)->withInput();
        } else {
            $status = ToolStatus::where('slug', (Auth::user()->isAdmin() || Auth::user()->isEmployee()) ? 'actief' : 'concept')->firstOrFail();
            $tool = Tool::create([
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'url'           => $request->input('url'),
                'uploader_id'   => Auth::id(),
                'category_slug' => $request->input('category'),
                'status_slug'   => $status->slug,
                'logo_filename' => $request->input('logo'),
            ]);

            // Here we create a ToolImage record for every image that has been uploaded
            for ($i = 0; $i < count($images); $i++) {
                ToolImage::create([
                    'tool_slug'      => $tool->slug,
                    'image_filename' => $images[$i]
                ]);
            }

            // Creating new records for tags
            $tags = $request->input('tags');
            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    $tool->tags()->attach($tag);
                }
            }

            if ($status->isConcept())
                Session::flash('message', 'Tool succesvol opgestuurd voor keuring!');
            else
                Session::flash('message', 'Tool succesvol toegevoegd!');

            return redirect()->route('tools.show', ['tool' => $tool->slug]);
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

        if ($tool->status->isConcept() && Auth::user()->isStudent() && $tool->uploader_id != Auth::user()->id) {
            Session::flash('message', 'Je hebt geen rechten om deze tool te bekijken');
            return redirect()->route('tools.index');
        }

        $curUserReview = $tool->reviews->where('user_id', Auth::id())->first();
        $questions = ToolQuestion::where('tool_slug', $slug)->withCount('upvotes')->orderBy('upvotes_count', 'desc')->get();
        Event::fire(new ViewTool($tool));

        return view('pages.tool.view', compact('tool', 'curUserReview', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slug
     * @return Response
     */
    public function edit($slug)
    {
        $tool = Tool::where('slug', $slug)->firstOrFail();

        if ((!$tool->status->isConcept() && Auth::user()->isStudent()) ||
            ($tool->status->isConcept() && ((Auth::user()->isStudent() && $tool->uploader_id != Auth::user()->id) || Auth::user()->isEmployee()))) {
            Session::flash('message', 'Je hebt geen rechten om deze tool aan te passen');
            return redirect()->route('tools.index');
        }

        $tags = ToolTag::all();
        $categories = ToolCategory::pluck('name','slug');
        return view('pages.tool.edit', compact('tool', 'categories', 'tags'));
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
     * encoded json string containing uploaded image filenames
     *
     * @param $slug
     *
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        $tool = Tool::where('slug', $slug)->firstOrFail();
        // Converting the images string with the filenames to an array and insert it into the request for validation
        $images = json_decode($request->input('images'));
        $thingsToValidate = array_merge($request->all(), ['images' => $images]);

        if ((!$tool->status->isConcept() && Auth::user()->isStudent()) ||
            ($tool->status->isConcept() && ((Auth::user()->isStudent() && $tool->uploader_id != Auth::user()->id) || Auth::user()->isEmployee()))) {
            Session::flash('message', 'Je hebt geen rechten om deze tool aan te passen');
            return redirect()->route('tools.index');
        }

        $feedback = $tool->feedback;
        $rules = [
            'name'        => ['required','max:255', new ToolDoesNotExist($tool)],
            'description' => 'required',
            'logo'        => ['required', new ImageExistsOnDisk],
            'category'    => 'required|exists:tool_category,slug',
            'images.*'    => [new ImageExistsOnDisk],
            'tags'        => new ToolOnlyOnceInList($request->input('tags')),
        ];

        $validator = Validator::make($thingsToValidate, $rules);
        if ($validator->fails()) {
            return redirect()->route('tools.edit', ['tool' => $slug])->withErrors($validator)->withInput();
        } else {
            $tool->name          = $request->input('name');
            $tool->description   = $request->input('description');
            $tool->url           = $request->input('url');
            $tool->uploader_id   = Auth::id();
            $tool->category_slug = $request->input('category');
            $tool->logo_filename = $request->input('logo');
            $tool->save();

            // Setting the feedback to fixed, if there was feedback
            if ($feedback != null) {
                $feedback->fixed = 1;
                $feedback->save();
            }

            // Deleting the old images
            $oldImages = ToolImage::where('tool_slug', $tool->slug)->pluck('image_filename')->all();
            $removedImages = array_diff($oldImages, $images);
            foreach ($removedImages as $removedImage_filename) {
                $this->deleteImage($removedImage_filename);
            }

            ToolImage::where('tool_slug', $tool->slug)->delete();
            // Here we create the new ToolImage records for every image that has been uploaded
            for ($i = 0; $i < count($images); $i++) {
                ToolImage::create([
                    'tool_slug'      => $tool->slug,
                    'image_filename' => $images[$i],
                ]);
            }

            // Deleting all tags from tool
            $tool->tags()->detach();

            // Creating new records for tags
            $tags = $request->input('tags');
            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    $tool->tags()->attach($tag);
                }
            }

            if ($feedback != null)
                Session::flash('message', 'Tool opnieuw opgestuurd voor keuring!');
            else
                Session::flash('message', 'Tool succesvol aangepast!');

            return redirect()->route('tools.show', ['tool' => $tool->slug]);
        }
    }

    public function uploadImage(Request $request) {
        $image = $request->file('image');

        $rules = [
            'image'    => 'required|image|mimes:jpeg,png,jpg,gif|max:1500',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $filename = null;
        do {
            $randomString = $this->generateRandomString();
            $filename = $this->saveImage($image, $randomString);
        } while (!$filename);

        return $filename;
    }
    /**
     * Remove an image
     *
     * @param Request $request
     * input filename
     * @return Repsonse
     */
    public function removeImage(Request $request) {
        $filename = $request->input('filename');
        /**
         * Check if the filename is already linked to a tool
         * If so check permissions to prevent the possibility to remove all the tool images as a student
         * Else the logged in user can remove any non linked image
         * I do not think the time between uploading and linking is enough for someone to
         * maliciously remove the image from the server with bruteforcing the filename
         */
        $toolImage = ToolImage::where('image_filename', $filename)->first();
        if ($toolImage != null) {
            $tool = $toolImage->tool;

            if ((!$tool->status->isConcept() && Auth::user()->isStudent()) ||
                ($tool->status->isConcept() && ((Auth::user()->isStudent() &&
                $tool->uploader_id != Auth::user()->id) || Auth::user()->isEmployee()))) {
                Session::flash('message', 'Je hebt geen rechten om deze tool aan te passen');
                return redirect()->route('tools.index');
            }
        }

        return $this->deleteImage($filename) ? 'deleted' : null;
    }


    /**
     * Activate the specified resource
     *
     * @param  int  $slug
     * @return Response
     */
    public function activate($slug)
    {
        if (!Auth::user()->isAdmin()) {
            Session::flash('message', 'Je hebt geen rechten om dat te doen');
            return redirect()->route('tools.index');
        }

        $tool = Tool::where('slug', $slug)->firstOrFail();
        $tool->status_slug = 'actief';
        $tool->save();

        Session::flash('message', 'Tool succesvol teruggezet!');
        return redirect()->route('portal');
    }

    /**
     * Deactivate the specified resource
     *
     * @param  int  $slug
     * @return Response
     */
    public function deactivate($slug)
    {
        if (!Auth::user()->isAdmin()) {
            Session::flash('message', 'Je hebt geen rechten om dat te doen');
            return redirect()->route('tools.index');
        }

        $tool = Tool::where('slug', $slug)->firstOrFail();
        $tool->status_slug = 'inactief';
        $tool->save();

        Session::flash('message', 'Tool succesvol gedeactiveerd!');
        return redirect()->route('portal');
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
        return new Response($image, 200, ['content-type' => 'image/jpeg']);
    }

    /**
     * Save a given image to the local disk with a given filename
     * Adds the image extention to the filename before saving
     * Will return null if the filenameWithExtention already exists
     *
     * @param UploadedFile $image
     * @return string $filenameWithExtention
     */
    private function saveImage($image, $filename)
    {
        $filenameWithExtention = $filename . '.' . $image->getClientOriginalExtension();
        if (Storage::disk('tool-images')->exists($filenameWithExtention))
            return null;

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


    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
