<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Support\ServiceProvider;

class AdmixServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->providers();

        $this->publish();
    }

    public function register(): void
    {
        $this->loadConfigs();
    }

    protected function providers(): void
    {
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    protected function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../../../resources/pint.json' => base_path('pint.json'),
            __DIR__ . '/../../../resources/phpstan.neon' => base_path('phpstan.neon'),
            __DIR__ . '/../../config/horizon.php' => base_path('config/horizon.php'),
        ], 'admix-config');

        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/admix'),
        ], ['admix-assets', 'laravel-assets']);
    }

    protected function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/admix.php', 'admix');
//        $this->mergeConfigFrom(__DIR__ . '/../config/local-operations.php', 'local-operations');
//        $this->mergeConfigFrom(__DIR__ . '/../config/gate.php', 'gate');
//        $this->mergeConfigFrom(__DIR__ . '/../config/audit-alias.php', 'audit-alias');
//        $this->mergeConfigFrom(__DIR__ . '/../config/upload-configs.php', 'upload-configs');
    }
}
