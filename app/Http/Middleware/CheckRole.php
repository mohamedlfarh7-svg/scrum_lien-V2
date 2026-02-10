<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user || !$user->roles()->whereIn('name', $roles)->exists()){
            abort(403, "Access denied. You do not have the required permissions.");
        }

        return $next($request);
    }
}
