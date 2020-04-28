<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
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
      if(!$request->user()->hasRole($role)) {
        if (sizeof($request->user()->roles)>=1) {
          return abort(404);
        }else {
          return redirect()->route('front.index');
        }
      }else {
        return $next($request);
      }

    }
}
