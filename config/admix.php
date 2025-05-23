<?php

return [
    'path' => env('ADMIX_PATH', 'admix'),
    'logo' => [
        'default' => asset('vendor/admix-ui/images/fmd.svg'),
        'negative' => asset('vendor/admix-ui/images/fmd-negative.svg'),
    ],
    'icon' => [
        'default' => asset('vendor/admix-ui/images/fmd-icon.svg'),
        'negative' => asset('vendor/admix-ui/images/fmd-icon-negative.svg'),
    ],
    'timestamp' => [
        'format' => env('ADMIX_TIMESTAMP_FORMAT', 'd/m/Y H:i:s'),
    ],
    'language' => [
        'default' => 'pt_BR',
        'available' => [
            'pt_BR' => [
                'name' => 'Português',
                'flag' => 'br',
            ],
            'en_US' => [
                'name' => 'English',
                'flag' => 'us',
            ],
            'es_ES' => [
                'name' => 'Espanhol',
                'flag' => 'es',
            ],
        ],
    ],
    'schedule' => [
        'minutes' => substr(base_convert(config('app.name'), 36, 5), 0, 2),
    ],
    'user' => [
        'name' => 'User',
        'icon' => 'user',
        'sort' => 20,
    ],
    'role' => [
        'name' => 'Role',
        'icon' => 'minus',
        'sort' => 30,
    ],
    'audit' => [
        'name' => 'Audit',
        'icon' => 'list-search',
        'sort' => 30,
    ],
];
