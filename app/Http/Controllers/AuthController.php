<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Socialite;
use Redirect;
use Auth;
use App\User;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $provider = 'avans';
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver($this->provider)->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver($this->provider)->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);

        return Redirect::to('portal');
    }

    public function findOrCreateUser($user)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'nickname' => $user->nickname,
            'firstName'=> $user->firstName,
            'lastName' => $user->lastName,
            'location' => $user->location,
            'role'     => $user->role,
            'provider' => $this->provider,
            'provider_id' => $user->id
        ]);
    }

    public function logout() {
        Auth::logout();

        return Redirect::route('home');
    }
}
