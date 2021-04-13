<?php

namespace App\Http\Middleware;

use Closure;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // dd($role);
        dd(\Auth::guard('guru')->user(), \Auth::user());
        if(\Auth::user()->role === $role) return $next($request);
        return generateAPI(['code' => 403, 'message' => 'Akses ditolak.']);
    }
}
