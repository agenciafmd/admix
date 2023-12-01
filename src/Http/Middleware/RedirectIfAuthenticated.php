<?php

namespace Agenciafmd\Admix\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (Auth::guard('admix-web')
            ->check()) {
            return redirect()->route('admix.dashboard');
        }

        return $next($request);
    }
}
