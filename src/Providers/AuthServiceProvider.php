<?php

namespace Agenciafmd\Admix\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        '\Agenciafmd\Admix\User' => '\Agenciafmd\Admix\Policies\UserPolicy',
        '\Agenciafmd\Admix\Role' => '\Agenciafmd\Admix\Policies\RolePolicy',
        '\Agenciafmd\Admix\Audit' => '\Agenciafmd\Admix\Policies\AuditPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
