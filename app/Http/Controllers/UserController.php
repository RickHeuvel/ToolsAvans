<?php

namespace App\Http\Controllers;

use App\ToolAcademy;
use Auth;
use Session;
use App\User;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the form for completing your profile
     *
     * @return Response
     */
    public function completeProfile()
    {
        $user = Auth::user();
        $academies = ToolAcademy::all();
        $route = Session::get('redirectUrl');
        return view('pages.user.completeprofile', compact('user', 'academies', 'route'));
    }

    /**
     * Store the form for completing your profile
     *
     * @return Response
     */
    public function storeProfile(Request $request)
    {
        $rules = [
            'useracademy' => 'nullable|exists:academy_lookup,slug'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('portal') . '#profile')->withErrors($validator)->withInput();
        } else {
            $user = Auth::user();
            if(!empty($request->input('useracademy')))
                $user->academy_slug = $request->input('useracademy');
            else
                $user->academy_slug = null;
            $user->save();
            return redirect(Session::get('redirectUrl'));
        }
    }

    /**
     * Update admins.
     *
     * @param $request
     * contains:
     * array with values 'admins[]'
     * 
     * @param $slug
     * 
     * @return Response
     */
    public function updateAdmins(Request $request)
    {
        $rules = [
            'admins' => 'array'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('portal') . '#adminpanel')->withErrors($validator)->withInput();
        } else {
            $admins = $request->input('admins');
            $users = User::all();
            foreach ($users as $user) {
                $user->admin = in_array($user->id, array_values($admins));
                $user->save();
            }

            Session::flash('message', 'Instellingen succesvol aangepast!');
            return redirect(route('portal') . '#adminpanel');
        }
    }
    
    /**
     * Update academy of the user.
     *
     * @param $request
     * contains:
     * the academy that the user selected
     * 
     * @return Response
     */

    public function updateAcademy(Request $request)
    {
        $rules = [
            'useracademy' => 'nullable|exists:academy_lookup,slug'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('portal') . '#profile')->withErrors($validator)->withInput();
        } else {
            $user = Auth::user();
            if(!empty($request->input('useracademy')))
                $user->academy_slug = $request->input('useracademy');
            else
                $user->academy_slug = null;
            $user->save();
            Session::flash('message', 'Academie succesvol aangepast!');
            return redirect(route('portal') . '#profile');
        }
    }
}
