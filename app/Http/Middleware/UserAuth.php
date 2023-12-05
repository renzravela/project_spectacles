<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $allowedUserType)
    {
        $user = auth()->user();

        // Allow admin to access all pages
        if ($user->user_type === 'admin') {
            return $next($request);
        }

        // Restrict regular users from accessing admin pages
        if ($user->user_type !== $allowedUserType) {
            abort(401);
        }

        return $next($request);
    }
}
