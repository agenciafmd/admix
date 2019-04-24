<?php

return [
    [
        'name' => 'Usuários',
        'policy' => '\Agenciafmd\Admix\Policies\UserPolicy',
        'abilities' => [
            [
                'name' => 'visualizar',
                'method' => 'view',
            ],
            [
                'name' => 'criar',
                'method' => 'create',
            ],
            [
                'name' => 'atualizar',
                'method' => 'update',
            ],
            [
                'name' => 'deletar',
                'method' => 'delete',
            ],
            [
                'name' => 'restarurar',
                'method' => 'restore',
            ],
        ],
        'sort' => 0,
    ],
    [
        'name' => 'Grupos',
        'policy' => '\Agenciafmd\Admix\Policies\RolePolicy',
        'abilities' => [
            [
                'name' => 'visualizar',
                'method' => 'view',
            ],
            [
                'name' => 'criar',
                'method' => 'create',
            ],
            [
                'name' => 'atualizar',
                'method' => 'update',
            ],
            [
                'name' => 'deletar',
                'method' => 'delete',
            ],
            [
                'name' => 'restarurar',
                'method' => 'restore',
            ],
        ],
        'sort' => 1,
    ],
    [
        'name' => 'Logs',
        'policy' => '\Agenciafmd\Admix\Policies\AuditPolicy',
        'abilities' => [
            [
                'name' => 'visualizar',
                'method' => 'view',
            ],
        ],
        'sort' => 2,
    ],
];
