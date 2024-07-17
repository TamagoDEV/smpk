<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // If not authenticated, redirect to login page
            return redirect()->route('login')->with('error', 'Anda Harus Login Terlebih Dahulu.');
        }

        // If authenticated, proceed to the next middleware or the request handler
        return $next($request);
    }
}
