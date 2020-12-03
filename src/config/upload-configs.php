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
                ],
            ],
        ],
    ],
];
