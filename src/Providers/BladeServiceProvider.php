<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootBladeComponents();

        $this->bootBladeDirectives();

        $this->bootBladeComposers();

        $this->bootMenu();

        $this->bootPaginator();

        $this->bootViews();

        $this->bootPublish();
    }

    public function register(): void
    {
        $this->app->singleton('admix-menu', function () {
            return collect();
        });
    }

    private function bootBladeComponents(): void
    {
        Blade::componentNamespace('Agenciafmd\\Admix\\Http\\Components', 'admix');
    }

    private function bootBladeComposers(): void
    {
        //
    }

    private function bootBladeDirectives(): void
    {
        //
    }

    private function bootMenu(): void
    {
        $this->app->make('admix-menu')
            ->push((object) [
                'component' => 'admix::aside.dashboard',
                'ord' => 1,
            ])
            ->push((object) [
                'component' => 'admix::aside.users',
                'ord' => 2,
            ])
            ->push((object) [
                'component' => 'admix::aside.logs',
                'ord' => 3,
            ]);
    }

    private function bootPaginator(): void
    {
        Paginator::defaultView('admix::partials.paginate.simple');
    }

    private function bootViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admix');
        $this->loadViewsFrom(__DIR__ . '/../../resources/mail', 'admix-mail');
    }

    private function bootPublish(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/agenciafmd/admix'),
        ], 'admix:views');
    }
}
