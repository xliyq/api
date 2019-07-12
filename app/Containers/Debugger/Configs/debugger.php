<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Debugger Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    'requests'     => [
        /*
        |--------------------------------------------------------------------------
        | requests Debugger
        |--------------------------------------------------------------------------
        |
        | 开启/关闭请求调试日志
        |
        */
        'debug'               => env('REQUEST_DEBUG', true),

        /*
         |--------------------------------------------------------------------------
         | Log File
         |--------------------------------------------------------------------------
         |
         | 日志存储位置(按天存储) `storage/logs` path.
         |
         */
        'log_file'            => 'requests/debugger.log',

        /*
         |--------------------------------------------------------------------------
         | Log Days
         |--------------------------------------------------------------------------
         |
         | 日志保存天数.
         |
         */
        'days'                => 14,

        /*
         |--------------------------------------------------------------------------
         | Response Show First
         |--------------------------------------------------------------------------
         |
         | Response 显示字数
         |
         */
        'response_show_first' => '70',

        /*
         |--------------------------------------------------------------------------
         | Token Show First
         |--------------------------------------------------------------------------
         |
         | Token 显示字数
         |
         */
        'token_show_first'    => '80'
    ],

    /*
    |--------------------------------------------------------------------------
    | Queries Debugger Settings
    |--------------------------------------------------------------------------
    |
    | 数据库日志配置
    */
    'queries'      => [

        /*
         |--------------------------------------------------------------------------
         | Debug
         |--------------------------------------------------------------------------
         |
         | 开启/关闭数据库输出日志
         |
         */
        'debug' => env('QUERIES_DEBUG', true),

        'output' => [
            /*
             |--------------------------------------------------------------------------
             | Log
             |--------------------------------------------------------------------------
             |
             | 输出到日志文件
             |
             */
            'log'     => true,

            /*
             |--------------------------------------------------------------------------
             | Log
             |--------------------------------------------------------------------------
             |
             | 输出到当前控制台或页面
             |
             */
            'console' => false
        ],
    ],

    /*
   |--------------------------------------------------------------------------
   | Running Time Debugger Settings
   |--------------------------------------------------------------------------
   |
   | 运行时间日志配置
   */
    'running_time' => [
        'debug'    => env('RUNNING_TIME_DEBUG', true),
        'log_file' => 'runningtimes/debugger.log',
        'days'     => 14
    ]
];