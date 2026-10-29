<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | Check Login
        |--------------------------------------------------------------------------
        */

        if (!auth()->check()) {
            abort(403, 'You are not authorized to access this page.');
        }


        /*
        |--------------------------------------------------------------------------
        | Get Current User
        |--------------------------------------------------------------------------
        */

        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | Get User Role
        |--------------------------------------------------------------------------
        */

        $userRole = $user->role;


        /*
        |--------------------------------------------------------------------------
        | Check Role
        |--------------------------------------------------------------------------
        */

        if (!in_array($userRole, $roles, true)) {
            abort(403, 'You are not authorized to access this page.');
        }


        /*
        |--------------------------------------------------------------------------
        | Allow Request
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}