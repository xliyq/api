<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    'clients' => [
        'web'    => [
            'id'     => env('CLIENT_ID_WEB'),
            'secret' => env('CLIENT_SECRET_WEB')
        ],
        'mobile' => [
            'id'     => env('CLIENT_ID_MOBILE'),
            'secret' => env('CLIENT_SECRET_MOBILE')
        ]
    ],

    'login' => [
        'prefix' => '',

        'allowed_login_attributes' => [
            'phone' => ['string', 'min:11', 'max:11']
        ]
    ]
];
