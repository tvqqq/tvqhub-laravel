<?php

namespace App\Http\Middleware;

use Closure;

class PreventAirlockUser
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
        if (!empty(auth()->id()) && auth()->id() === 2) {
            return abort(401);
        }
        return $next($request);
    }
}
