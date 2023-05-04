<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminMiddleware
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
        // This validation assumes you can access role from User Model
        if (Auth::user()) {
            $permissions = Permission::where([['role', $request->user()->role], ['access', 1]])->get();
            $uri = $request->route()->uri;
            if (false !== (array_search($uri, array_column($permissions->toArray(), 'module')))) {
                return $next($request);
            }
        } else {
            return response()->view('signIn');
        }
        return redirect('/stock');
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('sign-in');
        }
    }
}
