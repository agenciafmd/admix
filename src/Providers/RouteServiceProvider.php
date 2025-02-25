<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Http\Middleware\Authenticate;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            Route::prefix(config('admix.path'))
                ->middleware(['web', Authenticate::class . ':admix-web'])
                ->group(__DIR__ . '/../../routes/web.php');
        });
    }

    public function register(): void
    {
        $this->registerBindings();

        parent::register();
    }

    private function registerBindings(): void
    {
        //
    }
}
