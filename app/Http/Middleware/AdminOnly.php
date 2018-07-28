<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::id() && (Auth::user()->role === Config::get('constants.ADMIN_ROLE')
                || Auth::user()->role === Config::get('constants.ADMIN_ROLE_FOR_SENDING_MAIL'))) {
            return $next($request);
        }
        return redirect('/');
    }
}
