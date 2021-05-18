<?php

namespace App\Http\Middleware;

use Closure;

class RequestAjax
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
        return $request->ajax() ? $next($request) : abort(403);
    }
}
