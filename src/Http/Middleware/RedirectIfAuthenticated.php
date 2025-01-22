<?php

namespace Agenciafmd\Admix\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (auth('admix-web')
            ->check()) {
            return redirect()->route('admix.dashboard');
        }

        return $next($request);
    }
}
