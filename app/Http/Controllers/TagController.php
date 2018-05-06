<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Session;
use Auth;
use App\Tool;
use App\Tag;
use App\ToolTag;
use App\ToolCategory;
use App\Rules\TagDoesNotExist;

class TagController extends Controller
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
     * Show the form for creating a Tag.
     *
     * @param  int  $slug
     * @return Response
     */
    public function create()
    {        
        return view('pages.tag.create');
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
            'name' => 'required|unique:tool_tag_lookup|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('tags.create')->withErrors($validator)->withInput();
        } else {
            $default = !is_null($request->input('default'));
            $tag = Tag::create([
                'name' => $request->input('name'),
                'default' => $default,
            ]);
            Session::flash('message', 'Tag succesvol toegevoegd!');
            return redirect(route('portal') . '#tags');
        }
    }

    /**
     * Show the form for editing the specified Tag.
     *
     * @param  int  $slug
     * @return Response
     */
    public function edit($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        return view('pages.tag.edit', compact('tag'));
    }

    /**
     * Update a Tag.
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
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $rules = [
            'name' => ['required', new TagDoesNotExist($tag)]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('tags.edit', ['tag' => $slug])->withErrors($validator)->withInput();
        } else {
            $default = !is_null($request->input('default'));
            $tag->name = $request->input('name');
            $tag->default = $default;
            $tag->save();

            Session::flash('message', 'Tag succesvol aangepast!');
            return redirect(route('portal') . '#tags');
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
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $tag->delete();

        Session::flash('message', 'Tag succesvol verwijderd!');
        return redirect(route('portal') . '#tags');
    }
}
