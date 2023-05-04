<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;

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
        $permissions = Permission::where([['role', $request->user()->role], ['access', 1]])->get();
        $uri = $request->route()->uri;
        if (false !== (array_search($uri, array_column($permissions->toArray(), 'module')))) {
            return $next($request);
        }
        return redirect('/stock');
    }
}
