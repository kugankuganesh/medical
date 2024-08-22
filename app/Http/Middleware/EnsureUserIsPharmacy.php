<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsPharmacy
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role === 'pharmacy') {
            return $next($request);
        }

        return redirect('/home')->with('error', 'You do not have access to this section.');
    }
}
