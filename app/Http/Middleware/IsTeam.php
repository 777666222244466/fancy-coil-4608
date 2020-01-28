<?php

namespace App\Http\Middleware;

use Closure;

class IsTeam
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
        if (class_basename(auth()->user()) !== 'Team') {
            // come back to the redirect later.
            return redirect('home');
        }

        return $next($request);
    }
}
