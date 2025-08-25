<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmisiAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admisi')->check()) {
            return redirect()->route('admisi.login');
        }

        return $next($request);
    }
}
