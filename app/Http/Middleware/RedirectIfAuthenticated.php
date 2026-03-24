<?php

// =====================================================
// FILE: app/Http/Middleware/RedirectIfAuthenticated.php
// =====================================================
namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                // ✅ If authenticated as member → go to member dashboard
                if ($guard === 'member') {
                    return redirect()->route('member.dashboard');
                }

                // ✅ If authenticated as admin → go to admin dashboard
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
