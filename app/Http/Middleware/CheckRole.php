<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

       
        if (auth()->user()->role !== $role) {
            Log::warning('Unauthorized access attempt by user ID: ' . auth()->id());
            
            return redirect()->route($role === 'admin' ? 'admin.dashboard' : 'menu')
            ->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
