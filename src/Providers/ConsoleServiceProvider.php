<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Console\InstallCommand;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ConsoleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        $minutes = Cache::rememberForever('schedule-minutes', function () {
            return Str::of(random_int(0, 59))
                ->padLeft(2, 0)
                ->toString();
        });
    }
}
