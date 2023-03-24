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
        //
    }

    protected function providers(): void
    {
        $this->app->register(ConsoleServiceProvider::class);
    }

    protected function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../../resources/analysis/pint.json' => base_path('pint.json'),
            __DIR__ . '/../../resources/analysis/phpstan.neon' => base_path('phpstan.neon'),
            __DIR__ . '/../config/horizon.php' => base_path('config/horizon.php'),
        ], 'admix-config');
    }

    protected function loadConfigs()
    {
//        $this->mergeConfigFrom(__DIR__ . '/../config/local-operations.php', 'local-operations');
//        $this->mergeConfigFrom(__DIR__ . '/../config/gate.php', 'gate');
//        $this->mergeConfigFrom(__DIR__ . '/../config/audit-alias.php', 'audit-alias');
//        $this->mergeConfigFrom(__DIR__ . '/../config/upload-configs.php', 'upload-configs');
    }
}
