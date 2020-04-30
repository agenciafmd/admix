<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Commands\AdmixMediaClear;
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
            AdmixMediaClear::class,
            AdmixOptimize::class,
            AdmixUser::class,
            GenerateSitemap::class,
            NotificationsClear::class,
        ]);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);

            /*
             * evita que todos os crons do servidor compartilhado
             * rodem exatamente na mesma hora
             * */
            $minutes = cache()->rememberForever('schedule-minutes', function () {
                return str_pad(rand(0, 59), 2, STR_PAD_LEFT);
            });

            $schedule->command('queue:restart')
                ->everyThirtyMinutes();

            $schedule->command('queue:work --tries=3 --delay=5 --timeout=60 --queue=high,default,low')
                ->name(now()->format('H:i') . ' Rotina de processamento de fila')
                ->runInBackground()
                ->withoutOverlapping(30)
                ->everyMinute()
                ->appendOutputTo(storage_path('logs/command-queue-work-' . date('Y-m-d') . '.log'));

            $schedule->command('admix:optimize')
                ->withoutOverlapping()
                ->dailyAt("02:{$minutes}")
                ->appendOutputTo(storage_path('logs/command-admix-optimize-' . date('Y-m-d') . '.log'));

            $schedule->command('admix:media-clear')
                ->withoutOverlapping()
                ->dailyAt("02:{$minutes}")
                ->appendOutputTo(storage_path('logs/command-admix-media-clear-' . date('Y-m-d') . '.log'));

            $schedule->command('sitemap:generate')
                ->withoutOverlapping()
                ->dailyAt("03:{$minutes}")
                ->appendOutputTo(storage_path('logs/command-sitemap-generate-' . date('Y-m-d') . '.log'));

            $schedule->command('notifications:clear')
                ->withoutOverlapping()
                ->dailyAt("04:{$minutes}")
                ->appendOutputTo(storage_path('logs/command-notifications-clear-' . date('Y-m-d') . '.log'));
        });
    }
}
