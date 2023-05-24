<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadBladeComponents();

        $this->loadBladeDirectives();

        $this->loadBladeComposers();

        $this->setMenu();

        $this->setPaginator();

        $this->loadViews();

        $this->publish();
    }

    public function register(): void
    {
        $this->app->singleton('admix-menu', function () {
            return collect();
        });
    }

    protected function loadBladeComponents(): void
    {
        Blade::componentNamespace('Agenciafmd\\Admix\\Http\\Components', 'admix');
    }

    protected function loadBladeComposers(): void
    {
        //
    }

    protected function loadBladeDirectives(): void
    {
        //
    }

    protected function setMenu(): void
    {
        $this->app->make('admix-menu')
            ->push((object)[
                'component' => 'admix::aside.dashboard',
                'ord' => 1,
            ])->push((object)[
                'component' => 'admix::aside.users',
                'ord' => 2,
            ]);
    }

    protected function setPaginator(): void
    {
        Paginator::defaultView('admix::partials.paginate.simple');
    }

    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admix');
        $this->loadViewsFrom(__DIR__ . '/../../resources/mail', 'admix-mail');
    }

    protected function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/agenciafmd/admix'),
        ], 'admix:views');
    }
}
