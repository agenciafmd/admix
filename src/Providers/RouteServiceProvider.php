<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            Route::prefix(config('admix.url'))
                ->middleware(['web', 'auth:admix-web'])
                ->group(__DIR__ . '/../routes/web.php');

            Route::prefix(config('admix.url') . '/api')
                ->middleware('api')
                ->group(__DIR__ . '/../routes/api.php');
        });
    }
}
