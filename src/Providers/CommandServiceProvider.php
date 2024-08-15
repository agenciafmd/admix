<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Commands\AdmixUser;
use Agenciafmd\Admix\Commands\NotificationsClear;
use Agenciafmd\Admix\Models\Audit;
use Agenciafmd\Admix\Models\Role;
use Agenciafmd\Admix\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AdmixUser::class,
                NotificationsClear::class,
            ]);
        }

        $minutes = Cache::rememberForever('schedule-minutes', static function () {
            return str((string) random_int(0, 59))
                ->padLeft(2, '0')
                ->toString();
        });

        $this->app->booted(function () use ($minutes) {
            $schedule = $this->app->make(Schedule::class);

            $schedule->command('notifications:clear 90')
                ->withoutOverlapping()
                ->dailyAt("06:{$minutes}")
                ->appendOutputTo(storage_path('logs/command-notifications-clear-' . date('Y-m-d') . '.log'));

            $schedule->command('auth:clear-resets')
                ->everyFifteenMinutes();

            $schedule->command('model:prune', [
                '--model' => [
                    Audit::class,
                    Role::class,
                    User::class,
                ],
            ])
                ->dailyAt("03:{$minutes}");
        });
    }
}
