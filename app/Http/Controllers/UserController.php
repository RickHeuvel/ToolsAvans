<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
}
