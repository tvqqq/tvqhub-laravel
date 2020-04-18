<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class PreventAirlockUser
 * Airlock = Sanctum
 * @see https://laravel.com/docs/7.x/sanctum
 * @package App\Http\Middleware
 */
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
            auth()->logout();
            return redirect('/');
        }
        return $next($request);
    }
}
