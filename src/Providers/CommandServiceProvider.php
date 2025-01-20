<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Commands\AdmixUser;
use Agenciafmd\Admix\Commands\NotificationsClear;
use Agenciafmd\Admix\Models\Audit;
use Agenciafmd\Admix\Models\Role;
use Agenciafmd\Admix\Models\User;
use Illuminate\Console\Scheduling\Schedule;
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

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $minutes = config('admix.schedule.minutes');

            $schedule->command('auth:clear-resets')
                ->everyFifteenMinutes();
            $schedule->command('notifications:clear 90')
                ->withoutOverlapping()
                ->dailyAt("04:{$minutes}")
                ->appendOutputTo(storage_path('logs/command-notifications-clear-' . date('Y-m-d') . '.log'));
            $schedule->command('model:prune', [
                '--model' => [
                    Audit::class,
                ],
            ])
                ->dailyAt("03:{$minutes}");
            $schedule->command('model:prune', [
                '--model' => [
                    Role::class,
                ],
            ])
                ->dailyAt("03:{$minutes}");
            $schedule->command('model:prune', [
                '--model' => [
                    User::class,
                ],
            ])
                ->dailyAt("03:{$minutes}");
        });
    }
}
