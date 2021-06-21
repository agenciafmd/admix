<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Models\Role;
use Agenciafmd\Admix\Models\User;
use Agenciafmd\Admix\Observers\RoleObserver;
use Agenciafmd\Admix\Observers\UserObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace;
use RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments;
use RenatoMarinho\LaravelPageSpeed\Middleware\RemoveQuotes;
use Silber\PageCache\Middleware\CacheResponse;
use Spatie\Searchable\Search as SpatieSearch;

class AdmixServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->providers();

        $this->setObservers();

        $this->setMenu();

        $this->setMiddlewares();

        $this->loadMigrations();

        $this->loadTranslations();

        $this->publish();

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

        $this->app->singleton('admix-search', function () {
            return (new SpatieSearch())
                ->registerModel(User::class, 'name', 'email');
        });
    }

    protected function providers()
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(BroadcastServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
        $this->app->register(LivewireServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    protected function setObservers()
    {
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
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

        config(['auth.guards' => array_merge(config('admix.auth.guards'), config('auth.guards'))]);
        config(['auth.providers' => array_merge(config('admix.auth.providers'), config('auth.providers'))]);
        config(['auth.passwords' => array_merge(config('admix.auth.passwords'), config('auth.passwords'))]);
        config(['logging.channels' => array_merge(config('admix.logging.channels'), config('logging.channels'))]);

        if (config('mail.markdown.theme') === 'default') {
            config(['mail.markdown.theme' => config('admix.mail.markdown.theme')]);
        }
    }

    protected function publish()
    {
        // cd ~/code/packages/agenciafmd/admix/resources
        // npm run dev && php ~/code/starter/artisan vendor:publish --tag="admix:assets" --force
        // php artisan vendor:publish --tag="admix:assets" --force

        $this->publishes([
            __DIR__ . '/../config' => base_path('config'),
        ], 'admix:config');

        $this->publishes([
            __DIR__ . '/../resources/css' => public_path() . '/css',
            __DIR__ . '/../resources/fonts' => public_path() . '/fonts',
            __DIR__ . '/../resources/images' => public_path() . '/images',
            __DIR__ . '/../resources/js' => public_path() . '/js',
            __DIR__ . '/../resources/json' => public_path() . '/json',
//            __DIR__ . '/../resources/views/markdown/themes' => resource_path() . '/views/vendor/mail/html/themes',
        ], 'admix:assets');
    }
}
