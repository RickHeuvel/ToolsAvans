<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Redirect;
use Session;
use Auth;
use App\Tool;
use App\Specification;
use App\ToolSpecification;
use App\ToolCategory;


class SpecificationController extends Controller
{
    /**
     * Create a new controller instance
     * Require login and user to have admin role
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admingate');
    }

    /**
     * Show the form for creating a Specification.
     *
     * @param  int  $slug
     * @return Response
     */
    public function create()
    {
        $categories = ToolCategory::all();
        return view('pages.specification.create', compact('categories'));
    }

    /**
     * Store a new Specification
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
            'name' => 'required|unique:tool_specification_lookup|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('specifications/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            if(is_null($request->input('default'))){
                $default = false;
            }
            else{
                $default = true;
            }
            $specification = Specification::create([
                'slug' => Str::slug($request->input('name')),
                'name' => $request->input('name'),
                'default' => $default,
            ]);

            Session::flash('message', 'Specificatie succesvol toegevoegd!');
            return Redirect::to(route('portal') . '#specifications');
        }
    }

    /**
     * Show the form for editing the specified Specification.
     *
     * @param  int  $slug
     * @return Response
     */
    public function edit($slug)
    {
        $specification = Specification::where('slug', $slug)->firstOrFail();
        $categories = ToolCategory::all();
        return view('pages.specification.edit', compact('specification', 'categories'));
    }

    /**
     * Update a Specification.
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
        $specification = Specification::where('slug', $slug)->firstOrFail();

        $rules = [
            'name' => 'required',
            function($attribute, $value, $fail) use($specification){
                $newslug = Str::slug($value);
                if($specification->slug === $newslug){
                    return true;
                } else if(ToolSpecification::where('slug', $newslug)->exists()){
                    return $fail('Deze naam bestaat al');
                }
            },
            'category' => function($attribute, $value, $fail){
                if(ToolCategory::exists('slug', $value))
                {
                    return true;
                } else if(is_null($value)){
                    return true;
                } else {
                    return $fail('Categorie bestaat niet niet');
                }
            },
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('specifications/' . $slug . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            if(is_null($request->input('default'))){
                $default = false;
            }
            else{
                $default = true;
            }
            $specification->slug = Str::slug($request->input('name'));
            $specification->name = $request->input('name');
            $specification->default = $default;
            $specification->category = $request->input('category');
            $specification->save();

            Session::flash('message', 'Specificatie succesvol aangepast!');
            return Redirect::to(route('portal') . '#specifications');
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
        $specification = Specification::where('slug', $slug)->firstOrFail();
        $specification->delete();

        Session::flash('message', 'Specificatie succesvol verwijderd!');
        return Redirect::to(route('portal') . '#specifications');
    }
}
