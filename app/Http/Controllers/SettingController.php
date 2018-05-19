<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Setting;
use Session;

class SettingController extends Controller
{
    public function updateSettings(Request $request)
    {
        $rules = [
            'settings' => 'array'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('portal') . '#adminpanel')->withErrors($validator)->withInput();
        } else {
            foreach ($request->input('settings') as $name => $val) {
                $setting = Setting::where('name', $name)->first();
                if ($setting != null && empty($val)) {
                    $setting->delete();
                } else if ($setting != null) {
                    $setting->val = $val;
                    $setting->save();
                } else if (!empty($val)) {
                    $setting = Setting::create([
                        'name' => $name,
                        'val'  => $val
                    ]);
                }
            }

            Session::flash('message', 'Instellingen succesvol aangepast!');
            return redirect(route('portal') . '#adminpanel');
        }
    }
}
