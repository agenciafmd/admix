<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Models\Audit;
use Agenciafmd\Admix\Models\Role;
use Agenciafmd\Admix\Models\User;
use Agenciafmd\Admix\Policies\AuditPolicy;
use Agenciafmd\Admix\Policies\RolePolicy;
use Agenciafmd\Admix\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Audit::class => AuditPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        $this->loadAuthLoginOnLocal();
    }

    public function register(): void
    {
        $this->loadConfigs();
    }

    public function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/gate.php', 'gate');
    }

    private function loadAuthLoginOnLocal(): void
    {
        if ($this->app->environment(['local']) && !$this->app->runningInConsole()) {
            $user = new User;
            $user->name = 'Dev Local';
            $user->email = 'dev@fmd.ag';

            auth('admix-web')
                ->login($user);
        }
    }
}
