<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->routes(function () {
            Route::middleware('web')
                ->group(__DIR__ . '/../routes/web.php');

            Route::prefix('api')
                ->middleware('api')
                ->group(__DIR__ . '/../routes/api.php');
        });
    }
}
