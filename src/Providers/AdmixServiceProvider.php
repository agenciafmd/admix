<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Support\ServiceProvider;

class AdmixServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->providers();

        $this->loadMigrations();

        $this->loadTranslations();

        $this->publish();
    }

    public function register(): void
    {
        $this->loadConfigs();
    }

    private function providers(): void
    {
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(LivewireServiceProvider::class);
    }

    private function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../../.env.example' => base_path('.env.example'),
            __DIR__ . '/../../pint.json' => base_path('pint.json'),
            __DIR__ . '/../../phpstan.neon' => base_path('phpstan.neon'),
            __DIR__ . '/../../config/horizon.php' => base_path('config/horizon.php'),
            __DIR__ . '/../../config/livewire.php' => base_path('config/livewire.php'),
            __DIR__ . '/../../config/media-library.php' => base_path('config/media-library.php'),
            __DIR__ . '/../../tests/Pest.php' => base_path('tests/Pest.php'),
        ], 'admix:config');

        $this->publishes([
            __DIR__ . '/../../lang/pt_BR' => lang_path('pt_BR'),
        ], ['admix:translations']);
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    private function loadTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'admix');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../../lang');
    }

    private function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/admix.php', 'admix');
        $this->mergeConfigFrom(__DIR__ . '/../../config/audit.php', 'audit');
        $this->mergeConfigFrom(__DIR__ . '/../../config/audit-alias.php', 'audit-alias');
        //        $this->mergeConfigFrom(__DIR__ . '/../config/local-operations.php', 'local-operations');
        //        $this->mergeConfigFrom(__DIR__ . '/../config/upload-configs.php', 'upload-configs');
    }
}
