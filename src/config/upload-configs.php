<?php

return [
    'user' => [
        'image' => [
            'label' => 'imagem',
            'multiple' => false,
            'sources' => [
                [
                    'conversion' => 'thumb',
                    'media' => '(min-width: 1366px)',
                    'width' => 400,
                    'height' => 400,
                    'optimize' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? false : true,
                    'quality' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? 75 : 100,
                ],
            ],
        ],
    ],
];
