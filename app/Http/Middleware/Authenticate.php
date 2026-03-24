<?php

// =====================================================
// FILE: app/Http/Middleware/Authenticate.php
// =====================================================
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {

            // ✅ If trying to access a member route → redirect to member login
            if ($request->is('member/*') || $request->routeIs('member.*')) {
                return route('member.login');
            }

            // ✅ Default → redirect to admin login
            return route('login');
        }

        return null;
    }
}
