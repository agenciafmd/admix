<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Support\ServiceProvider;

class AdmixServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->providers();
    }

    public function register(): void
    {
        //
    }

    protected function providers()
    {
        $this->app->register(ConsoleServiceProvider::class);
    }
}
