<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if ($user->status === 'banned') {
            auth()->logout();

            return redirect()->route('login')->withErrors(['email' => 'votre compte est banni.']);
        }

        if ($user->id === 1) {
            return $next($request);
        }

        if ($user->role !== 'admin') {
            abort(403, 'Accès réservé à l administrateur.');
        }

        return $next($request);
    }
}