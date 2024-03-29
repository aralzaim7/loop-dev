<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->is_admin == 1) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error','You do not have permission to enter "'.$request->getRequestUri().'" url.');
    }
}