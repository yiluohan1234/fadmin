<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (fadmin_auth()->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response(trans('base.unauthorized'), 401);
            } else {
                return redirect()->guest(fadmin_url('login'));
            }
        }
        return $next($request);
    }
}
