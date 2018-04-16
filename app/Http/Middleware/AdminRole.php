<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use Redirect;

class AdminRole
{
    /**
     * Force the user to login and check if current user is an admin
     * The auth middleware needs to be executed before this middlware!
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->isAdmin()) {
            Session::flash('message', 'Administrator rechten vereist');
            return redirect()->route('portal');
        }
        return $next($request);
    }
}
