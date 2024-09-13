<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and is an admin
        if ($request->user() && $request->user()->type === 'admin') {
            return $next($request);
        }

        // If not admin, redirect or return an unauthorized response
        abort(403, 'Unauthorized action.');
    }
}