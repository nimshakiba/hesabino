<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBusiness
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !session('current_business_id')) {
            if (!$request->routeIs('business.create') && !$request->routeIs('business.store')) {
                return redirect()->route('business.create');
            }
        }
        return $next($request);
    }
}
