<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Session;
use Auth;
use App\TagCategory;
use App\Rules\TagCategoryDoesNotExist;

class TagCategoryController extends Controller
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
     * Show the form for creating a TagCategory.
     *
     * @param  int  $slug
     * @return Response
     */
    public function create()
    {        
        return view('pages.tagcategories.create');
    }

    /**
     * Store a new Tag
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
            'name' => 'required|unique:tag_category|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('tagcategories.create')->withErrors($validator)->withInput();
        } else {
            $tag = TagCategory::create([
                'name' => $request->input('name'),
            ]);
            Session::flash('message', 'Tag categorie succesvol toegevoegd!');
            return redirect(route('portal') . '#tagcategories');
        }
    }

    /**
     * Show the form for editing the specified TagCategory.
     *
     * @param  int  $slug
     * @return Response
     */
    public function edit($slug)
    {
        $tagCategory = TagCategory::where('slug', $slug)->firstOrFail();
        return view('pages.tagcategories.edit', compact('tagCategory'));
    }

    /**
     * Update a TagCategory.
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
        $tagCategory = TagCategory::where('slug', $slug)->firstOrFail();

        $rules = [
            'name' => ['required', new TagCategoryDoesNotExist($tagCategory)],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('tagcategories.edit', ['tagCategory' => $slug])->withErrors($validator)->withInput();
        } else {
            $tagCategory->name = $request->input('name');
            $tagCategory->save();

            Session::flash('message', 'Tag categorie succesvol aangepast!');
            return redirect(route('portal') . '#tagcategories');
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
        $tagCategory = TagCategory::where('slug', $slug)->firstOrFail();
        $tagCategory->delete();

        Session::flash('message', 'Tag categorie succesvol verwijderd!');
        return redirect(route('portal') . '#tagcategories');
    }
}
