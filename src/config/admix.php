<?php

return [
    'url' => 'admix',
    'name' => 'Agência F&MD',
    'turbo' => env('TURBO_ENABLED', false),
    'auth' => [
        'guards' => [
            'admix-web' => [
                'driver' => 'session',
                'provider' => 'admix-users',
            ],
            'admix-api' => [
                'driver' => 'token',
                'provider' => 'admix-users',
            ],
        ],

        'providers' => [
            'admix-users' => [
                'driver' => 'eloquent',
                'model' => \Agenciafmd\Admix\Models\User::class,
            ],
        ],

        'passwords' => [
            'admix-users' => [
                'provider' => 'admix-users',
                'table' => 'password_resets',
                'expire' => 60,
            ],
        ],
    ],
    'logging' => [
        'channels' => [
            'admix' => [
                'driver' => 'daily',
                'path' => storage_path('logs/admix.log'),
                'level' => 'debug',
                'days' => 14,
            ],
            'admix-slack' => [
                'driver' => 'slack',
                'url' => env('LOG_SLACK_WEBHOOK_URL'),
                'username' => 'WALL-E',
                'tap' => [
                    //
                ],
                'emoji' => 'boom',
                'level' => 'info',
                'short' => false,
                'context' => true,
                'exclude_fields' => [
                    //
                ],
            ],
        ],
    ],
    'manifest' => [
        'name' => 'Admix',
        'short_name' => 'Admix',
        'description' => 'Painel Administrativo | Agência F&MD',
        'scope' => '/admix',
        'start_url' => '/admix/login?utm_source=pwa',
        'display' => 'standalone',
        'background_color' => '#FFFFFF',
        'theme_color' => '#2196F3',
    ],
    'sw' => [
        'name' => env('SW_NAME', 'sw-admix-v1'),
        'files' => [
            'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700', //font do /offline
            '/images/icons/favicon.ico',
            '/css/backend.css',
            '/js/backend.js',
            '/admix/offline',
        ],
    ],
];
