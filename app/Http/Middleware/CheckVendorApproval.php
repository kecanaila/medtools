<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckVendorApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isVendor()) {
            if (!Auth::user()->isApprovedVendor()) {
                return redirect()->route('home')->with('error', 'Your vendor account is pending approval. Please wait for admin approval.');
            }
        }

        return $next($request);
    }
} 