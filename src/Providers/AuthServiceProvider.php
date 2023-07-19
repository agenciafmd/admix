<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Models\Role;
use Agenciafmd\Admix\Models\User;
use Agenciafmd\Admix\Policies\RolePolicy;
use Agenciafmd\Admix\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }

    public function register(): void
    {
        $this->loadConfigs();
    }

    public function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/gate.php', 'gate');
    }
}
