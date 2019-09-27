<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Commands\AdmixOptimize;
use Agenciafmd\Admix\Commands\AdmixUser;
use Agenciafmd\Admix\Commands\GenerateSitemap;
use Agenciafmd\Admix\Commands\NotificationsClear;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            AdmixUser::class,
            AdmixOptimize::class,
            GenerateSitemap::class,
            NotificationsClear::class,
        ]);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('queue:work --tries=3 --delay=5 --timeout=60 --stop-when-empty')
                ->name('Rotina de processamento de fila')
                ->withoutOverlapping(5)
                ->everyMinute()
                ->appendOutputTo(storage_path('logs/command-queue-work-' . date('Y-m-d') . '.log'));

            $schedule->command('admix:optimize')
                ->withoutOverlapping()
                ->dailyAt('02:00')
                ->appendOutputTo(storage_path('logs/command-admix-optimize-' . date('Y-m-d') . '.log'));

            $schedule->command('sitemap:generate')
                ->withoutOverlapping()
                ->dailyAt('03:00')
                ->appendOutputTo(storage_path('logs/command-sitemap-generate-' . date('Y-m-d') . '.log'));

            $schedule->command('notifications:clear')
                ->withoutOverlapping()
                ->dailyAt('03:30')
                ->appendOutputTo(storage_path('logs/command-notifications-clear-' . date('Y-m-d') . '.log'));
        });
    }
}
