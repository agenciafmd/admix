<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            \Agenciafmd\Admix\Commands\AdmixUser::class,
            \Agenciafmd\Admix\Commands\AdmixOptimize::class,
            \Agenciafmd\Admix\Commands\GenerateSitemap::class,
            \Agenciafmd\Admix\Commands\NotificationsClear::class,
        ]);

        $this->app->booted(function () {
//            $schedule = $this->app->make(\Illuminate\Console\Scheduling\Schedule::class);
//            $schedule->command('queue:work --once --tries=5 --timeout=60')->name('Rotina de processamento de fila')->withoutOverlapping(5)->everyMinute()
//                ->appendOutputTo(storage_path('logs/command-queue-work-' . date('Y-m-d') . '.log'));
//            $schedule->command('admix:optimize')->withoutOverlapping()->dailyAt('02:00')
//                ->appendOutputTo(storage_path('logs/command-admix-optimize-' . date('Y-m-d') . '.log'));
//            $schedule->command('sitemap:generate')->withoutOverlapping()->dailyAt('03:00')
//                ->appendOutputTo(storage_path('logs/command-sitemap-generate-' . date('Y-m-d') . '.log'));
//            $schedule->command('notifications:clear')->withoutOverlapping()->dailyAt('03:30')
//                ->appendOutputTo(storage_path('logs/command-notifications-clear-' . date('Y-m-d') . '.log'));
        });
    }
}
