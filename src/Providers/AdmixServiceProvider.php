<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace;
use RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments;
use RenatoMarinho\LaravelPageSpeed\Middleware\RemoveQuotes;
use Silber\PageCache\Middleware\CacheResponse;

class AdmixServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->providers();

        $this->setMenu();

        $this->setMiddlewares();

        $this->setPaginator();

        $this->loadViews();

        $this->loadMigrations();

        $this->loadTranslations();

        $this->loadBladeDirectives();

        $this->publish();

        if ($this->app->environment(['local', 'testing']) && $this->app->runningInConsole()) {
            $this->setLocalFactories();
        }

        if ($this->app->environment(['local']) && !$this->app->runningInConsole()) {
            $user = new User();
            $user->name = 'Anônimo';
            $user->email = 'anonimo@fmd.ag';

            Auth::guard('admix-web')
                ->login($user);
        }
    }

    public function register()
    {
        $this->loadConfigs();

//        $this->app->singleton(
//            \Illuminate\Contracts\Debug\ExceptionHandler::class,
//            \Agenciafmd\Admix\Exceptions\Handler::class
//        );

        $this->app->singleton('admix-menu', function () {
            return collect();
        });
    }

    public function setLocalFactories()
    {
        $this->app->make('Illuminate\Database\Eloquent\Factory')
            ->load(__DIR__ . '/../database/factories');
    }

    protected function providers()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
        $this->app->register(BroadcastServiceProvider::class);
    }

    protected function setMenu()
    {
        $this->app->make('admix-menu')
            ->push((object)[
                'view' => 'agenciafmd/admix::partials.menus.item.dashboard',
                'ord' => 1,
            ]);

        $this->app->make('admix-menu')
            ->push((object)[
                'view' => 'agenciafmd/admix::partials.menus.item.users',
                'ord' => 2,
            ]);

        $this->app->make('admix-menu')
            ->push((object)[
                'view' => 'agenciafmd/admix::partials.menus.item.configs',
                'ord' => 3,
            ]);
    }

    protected function setMiddlewares()
    {
        $turboGroup = [];
        if (config('admix.turbo')) {
            $turboGroup = array_merge($turboGroup, [
                CacheResponse::class,
                RemoveComments::class,
                RemoveQuotes::class,
                CollapseWhitespace::class,
            ]);
        }

        $this->app->router->middlewareGroup('turbo', $turboGroup);
    }

    protected function setPaginator()
    {
        Paginator::defaultView('agenciafmd/admix::partials.paginate.simple');
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agenciafmd/admix');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agenciafmd/flash');
    }

    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'agenciafmd/admix');
    }

    protected function loadConfigs()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admix.php', 'admix');
        $this->mergeConfigFrom(__DIR__ . '/../config/gate.php', 'gate');
        $this->mergeConfigFrom(__DIR__ . '/../config/audit.php', 'audit');
        $this->mergeConfigFrom(__DIR__ . '/../config/audit-alias.php', 'audit-alias');
        $this->mergeConfigFrom(__DIR__ . '/../config/upload-configs.php', 'upload-configs');
        $this->mergeConfigFrom(__DIR__ . '/../config/queue-ensurer.php', 'queue-ensurer');

        config(['auth.guards' => array_merge(config('admix.auth.guards'), config('auth.guards'))]);
        config(['auth.providers' => array_merge(config('admix.auth.providers'), config('auth.providers'))]);
        config(['auth.passwords' => array_merge(config('admix.auth.passwords'), config('auth.passwords'))]);
    }

    protected function loadBladeDirectives()
    {
        Blade::directive('render', function ($component) {
            return "<?php echo (app($component))->toHtml(); ?>";
        });
    }

    protected function publish()
    {
        // cd ~/code/packages/agenciafmd/admix/resources
        // npm run dev && php ~/code/starter/artisan vendor:publish --provider="Agenciafmd\Admix\Providers\AdmixServiceProvider" --tag="assets" --force
        // php artisan vendor:publish --provider="Agenciafmd\Admix\Providers\AdmixServiceProvider" --tag="assets" --force

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/agenciafmd/admix'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/../config' => base_path('config'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../resources/css' => public_path() . '/css',
            __DIR__ . '/../resources/fonts' => public_path() . '/fonts',
            __DIR__ . '/../resources/images' => public_path() . '/images',
            __DIR__ . '/../resources/js' => public_path() . '/js',
            __DIR__ . '/../resources/json' => public_path() . '/json',
        ], 'assets');
    }
}
