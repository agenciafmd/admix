<?php

namespace Agenciafmd\Admix\Providers;

use Agenciafmd\Admix\Models\Audit;
use Agenciafmd\Admix\Policies\AuditPolicy;
use Agenciafmd\Admix\Policies\RolePolicy;
use Agenciafmd\Admix\Policies\UserPolicy;
use Agenciafmd\Admix\Models\Role;
use Agenciafmd\Admix\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Audit::class => AuditPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
