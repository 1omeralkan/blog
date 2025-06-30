<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guard = $guards[0] ?? null;

        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();

            if ($user->isAdmin()) {
    return redirect('/admin/dashboard');
}
return redirect('/dashboard');

        }

        return $next($request);
    }
}
