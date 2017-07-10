<?php

namespace App\Http\Middleware;

use Closure;

class UserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->active) {
            auth()->logout();
            return redirect()->to('login')->with('warning','ur account not activated .. check your inbox');
        }
        return $next($request);
    }
}
