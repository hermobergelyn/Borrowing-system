<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && blank($user->role)) {
            if (! $request->routeIs('role.select', 'role.store', 'logout')) {
                return redirect()->route('role.select');
            }
        }

        if ($user && filled($user->role) && blank($user->profile_completed_at)) {
            if (! $request->routeIs('role.select', 'role.store', 'profile.complete', 'profile.complete.store', 'logout')) {
                return redirect()->route('profile.complete');
            }
        }

        return $next($request);
    }
}
