<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $user = Auth::user();

        $adminRole = Role::where('name', 'admin')->first();
        if (!$adminRole || $user->role_id !== $adminRole->id) {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}