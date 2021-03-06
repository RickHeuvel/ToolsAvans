<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Session;
use App\User;
use Log;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    
    private $provider = 'avans';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect to OAuth provider to login
     *
     * @return void
     */
    public function redirectToProvider()
    {
        Session::put('redirectUrl', url()->previous());
        return Socialite::driver($this->provider)->redirect();
    }

    /**
     * Handle successful login attempt
     * @return Redirect
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver($this->provider)->user();
        $redirect = $this->login($user);
        return $redirect;
    }

    /**
     * Login a user
     *
     * @return Redirect
     */
    public function login($user)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        
        if ($authUser) {
            Auth::login($authUser, true);
            if (Session::has('redirectUrl'))
                return redirect(Session::get('redirectUrl'));
            else
                return redirect()->route('portal');
        } else {
            $authUser = $this->createUser($user);
            Auth::login($authUser, true);
            return redirect()->route('users.completeprofile');
        }
    }

    /**
     * Check if user exists
     * If not: create and return user
     * Else: return existing user
     *
     * @return User
     */
    public function createUser($user)
    {
        return User::create([
            'name'        => $user->name,
            'email'       => $user->email,
            'nickname'    => $user->nickname,
            'firstName'   => $user->firstName,
            'lastName'    => $user->lastName,
            'location'    => $user->location,
            'role'        => $user->role,
            'provider'    => $this->provider,
            'provider_id' => $user->id,
            'admin'       => (!empty($user->admin)) ? $user->admin : false
        ]);
    }

    /**
     * Remove session and logout
     *
     * @return Redirect
     */
    public function logout() {
        Auth::logout();

        return redirect()->route('home');
    }
}
