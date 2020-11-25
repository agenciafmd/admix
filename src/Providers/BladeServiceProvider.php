<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadBladeComponents();

        $this->loadBladeDirectives();

        $this->loadBladeComposers();

        $this->setPaginator();

        $this->loadViews();

        $this->publish();
    }

    public function register()
    {
        //
    }

    protected function loadBladeComponents()
    {
        //
    }

    protected function loadBladeComposers()
    {
        //
    }

    protected function loadBladeDirectives()
    {
        Blade::directive('render', function ($component) {
            return "<?php echo (app($component))->toHtml(); ?>";
        });
    }

    protected function setPaginator()
    {
        Paginator::defaultView('agenciafmd/admix::partials.paginate.simple');
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admix');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agenciafmd/admix'); // deprecated
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agenciafmd/flash');
    }

    protected function publish()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/agenciafmd/admix'),
        ], 'admix:views');
    }
}
