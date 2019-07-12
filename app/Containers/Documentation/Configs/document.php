<?php

return [
    'types' => [
//        'public' => [
//            'url' => 'api/docs',
//            'routes' => [
//                'public'
//            ],
//        ],
        'private' => [
            'url' => 'api/docs',
            'routes' => [
                'public',
                'private'
            ]
        ]
    ],

    'html_files' => 'public/',

    'template' => 'docsify'
];