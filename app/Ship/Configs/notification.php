<?php

return [

    'jpush' => [
        'app_key'    => env('JPUSH_APP_KEY', ''),
        'app_secret' => env('JPUSH_MASTER_SECRET', ''),
        'log'        => env('JPUSH_LOG', null)
    ],

    'sms' => [
        'access_key_id' => env('ALIYUN_ACCESS_KEY_ID', ''),
        'access_secret' => env('ALIYUM_ACCESS_SECRET', ''),
        'sign_name'     => env('ALIYUM_SMS_SIGN_NAME', ''),
        'region'        => env('ALIYUM_SMS_REGION', '')
    ],
];