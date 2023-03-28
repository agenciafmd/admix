<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Commands\InstallCommand;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        $minutes = Cache::rememberForever('schedule-minutes', static function () {
            return Str::of((string) random_int(0, 59))
                ->padLeft(2, '0')
                ->toString();
        });
    }
}
