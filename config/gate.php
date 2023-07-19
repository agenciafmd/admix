<?php

use Agenciafmd\Admix\Policies\RolePolicy;
use Agenciafmd\Admix\Policies\UserPolicy;

return [
    [
        'name' => config('admix.user.name') . ' » ' . config('admix.user.name'),
        'policy' => UserPolicy::class,
        'abilities' => [
            [
                'name' => 'View',
                'method' => 'view',
            ],
            [
                'name' => 'Create',
                'method' => 'create',
            ],
            [
                'name' => 'Update',
                'method' => 'update',
            ],
            [
                'name' => 'Delete',
                'method' => 'delete',
            ],
            [
                'name' => 'Restore',
                'method' => 'restore',
            ],
        ],
        'sort' => 0,
    ],
    [
        'name' => config('admix.user.name') . ' » ' . config('admix.role.name'),
        'policy' => RolePolicy::class,
        'abilities' => [
            [
                'name' => 'View',
                'method' => 'view',
            ],
            [
                'name' => 'Create',
                'method' => 'create',
            ],
            [
                'name' => 'Update',
                'method' => 'update',
            ],
            [
                'name' => 'Delete',
                'method' => 'delete',
            ],
            [
                'name' => 'Restore',
                'method' => 'restore',
            ],
        ],
        'sort' => 1,
    ],
];
