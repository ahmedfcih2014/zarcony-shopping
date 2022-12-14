<?php

namespace App\Http\Middleware;

use App\Enum\UserEnum;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            auth()->guard('admin')->check() &&
            auth()->guard('admin')->user()->user_role == UserEnum::admin_role
        ) return $next($request);
        return redirect(route("admin.login"));
    }
}
