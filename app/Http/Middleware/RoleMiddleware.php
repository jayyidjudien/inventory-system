<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage: ->middleware(\App\Http\Middleware\RoleMiddleware::class . ':admin')
     */
    public function handle(Request $request, Closure $next, ...$roles)
{
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    // Ambil role user
    $current = null;
    if (isset($user->role) && is_object($user->role)) {
        $current = $user->role->name ?? null;
    }
    if (is_null($current) && isset($user->role) && is_string($user->role)) {
        $current = $user->role;
    }
    if (is_null($current) && isset($user->role_name)) {
        $current = $user->role_name;
    }

    // Pecah parameter "admin|warehouse" jadi array
    $parsed = [];
    foreach ($roles as $r) {
        foreach (explode('|', $r) as $part) {
            $parsed[] = strtolower(trim($part));
        }
    }

    $current = is_string($current) ? strtolower(trim($current)) : null;

    if ($current && in_array($current, $parsed, true)) {
        return $next($request);
    }

    if (config('app.debug')) {
        abort(403, 'Unauthorized. current_role=' . ($current ?? 'null') . ' allowed=' . implode(',', $parsed));
    }

    abort(403, 'Unauthorized.');
}
}