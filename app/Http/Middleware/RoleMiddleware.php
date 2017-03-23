<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class RoleMiddleware
 * @package App\Http\Middleware
 */
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission)
    {
        if (auth()->guest()) {
            return redirect(url('login'));
        }

        if (! $request->user()->hasRole($role)) {
            abort(403);
        }

        if (! $request->user()->can($permission)) {
            abort(403);
        }

        return $next($request);
    }
}
