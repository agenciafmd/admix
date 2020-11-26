<?php

return [
    [
        'name' => 'Usuários » Usuários',
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
                'name' => 'restaurar',
                'method' => 'restore',
            ],
        ],
        'sort' => 0,
    ],
    [
        'name' => 'Usuários » Grupos',
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
                'name' => 'restaurar',
                'method' => 'restore',
            ],
        ],
        'sort' => 1,
    ],
    [
        'name' => 'Configurações » Logs',
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
