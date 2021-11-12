<?php

namespace VotingSystem\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if($guard === 'admin'){
                return redirect('/');
            }
            if($guard === 'web'){
                return redirect()->route('web::home');
            }
        }

        return $next($request);
    }
}
