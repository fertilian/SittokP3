<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Pengguna belum melakukan login, arahkan ke halaman login
            return redirect()->route('loginn');
        }

        return $next($request);
    }
}
