<?php

namespace VotingSystem\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        Auth::shouldUse($guard);
        if (!Auth::guard($guard)->check()) {
            if($guard == 'admin'){
                return redirect()->guest(route('admin::login'));
            }else{
                return redirect()->guest(route('web::login.index'));
            }
        }
        return $next($request);
    }
}
