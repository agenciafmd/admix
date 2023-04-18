<?php

namespace Agenciafmd\Admix\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            return route('admix.auth.login');
        }

        return null;
    }
}
