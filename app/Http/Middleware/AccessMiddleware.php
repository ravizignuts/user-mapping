<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $module, $permission)
    {
        if (Auth::user()->type == 'admin') {
            // return response()->json(['Admin Can Access']);
            return $next($request);
        } else {
            $access =  Auth::user()->hasUser($module, $permission); //Module name,permission
            if ($access) {
                return $next($request);
            } else {
                return response()->json(['Access Forbidden']);
            }
        }
    }
}
