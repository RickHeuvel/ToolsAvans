<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Session;
use Auth;
use App\Tool;
use App\Specification;
use App\ToolSpecification;
use App\ToolCategory;
use App\Rules\SpecificationDoesNotExist;

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
        $this->middleware(['auth', 'adminrole']);
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
            return redirect()->route('specifications.create')->withErrors($validator)->withInput();
        } else {
            $default = !is_null($request->input('default'));
            $specification = Specification::create([
                'name' => $request->input('name'),
                'category' => $request->input('category'),
                'default' => $default,
            ]);

            Session::flash('message', 'Specificatie succesvol toegevoegd!');
            return redirect(route('portal') . '#specifications');
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
            'name' => ['required', new SpecificationDoesNotExist($specification)]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('specifications.edit', ['specification' => $slug])->withErrors($validator)->withInput();
        } else {
            $default = !is_null($request->input('default'));
            $specification->name = $request->input('name');
            $specification->default = $default;
            $specification->category = $request->input('category');
            $specification->save();

            Session::flash('message', 'Specificatie succesvol aangepast!');
            return redirect(route('portal') . '#specifications');
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
        return redirect(route('portal') . '#specifications');
    }
}
