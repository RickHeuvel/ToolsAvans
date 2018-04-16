<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Validator;
use Input;
use Session;
use App\Tool;
use App\ToolCategory;
use App\Rules\NameExistsInDatabase;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance
     * Require login and user to have admin role
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'adminrole']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a new Category
     *
     * @param $request
     * contains:
     * string 'name'
     * 
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:tool_category|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('categories.create')->withErrors($validator)->withInput();
        } else {
            $category = ToolCategory::create([
                'name' => $request->input('name')
            ]);

            Session::flash('message', 'Categorie succesvol toegevoegd!');
            return redirect(route('portal') . '#categories');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slug
     * @return Response
     */
    public function edit($slug)
    {
        $category = ToolCategory::where('slug', $slug)->firstOrFail();
        return view('pages.category.edit', compact('category'));
    }

    /**
     * Update a Category.
     *
     * @param $request
     * contains:
     * string 'name'
     * 
     * @param $slug
     * 
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        $category = ToolCategory::where('slug', $slug)->firstOrFail();

        $rules = [
            'name' => 'required|unique:tool_category|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('categories.edit', ['category' => $slug])->withErrors($validator)->withInput();
        } else {
            $tools = Tool::all()->where('category_slug', $slug);

            $category->name = $request->input('name');
            $category->save();

            foreach ($tools as $tool) {
                $tool->category_slug = Str::slug($category->name);
                $tool->save();
            }

            Session::flash('message', 'Category succesvol aangepast!');
            return redirect(route('portal') . '#categories');
        }
    }

    /**
     * Remove the specified resource
     *
     * @param  int  $slug
     * @return Response
     */
    public function destroy($slug)
    {
        $tools = Tool::all()->where('category_slug', $slug);
        foreach ($tools as $tool) {
            $tool->category_slug = '';
            $tool->save();
        }

        $category = ToolCategory::where('slug', $slug)->firstOrFail();
        $category->delete();

        Session::flash('message', 'Categorie succesvol verwijderd!');
        return redirect(route('portal') . '#categories');
    }
}
