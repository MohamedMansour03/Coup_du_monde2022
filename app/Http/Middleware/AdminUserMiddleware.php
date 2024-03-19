<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth class
use App\Models\User; // Import User model
use Symfony\Component\HttpFoundation\Response;

class AdminUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role != User::ADMIN_ROLE) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
