<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadBladeComponents();

        $this->loadBladeDirectives();

        $this->loadBladeComposers();

        $this->setPaginator();

        $this->loadViews();

        $this->publish();
    }

    public function register(): void
    {
        //
    }

    protected function loadBladeComponents(): void
    {
        //
    }

    protected function loadBladeComposers(): void
    {
        //
    }

    protected function loadBladeDirectives(): void
    {
        //
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
