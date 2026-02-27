<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisitorSession
{
    /**
     * Handle an incoming request.
     * Only allow users with role 'visitor' to access.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/');
        }

        if (auth()->user()->role !== 'visitor') {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
