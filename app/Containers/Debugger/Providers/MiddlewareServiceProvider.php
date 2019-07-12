<?php


namespace App\Containers\Debugger\Providers;


use App\Containers\Debugger\Middlewares\ProfileMiddleware;
use App\Containers\Debugger\Middlewares\RequestMonitorMiddleware;
use App\Containers\Debugger\Middlewares\RunningTimeMiddleware;
use Porto\Core\Providers\Abstracts\CoreMiddlewareProvider;

class MiddlewareServiceProvider extends CoreMiddlewareProvider
{
    protected $middlewares = [
        RequestMonitorMiddleware::class,
        RunningTimeMiddleware::class,
    ];

    protected $middlewareGroups = [
        'api' => [
            ProfileMiddleware::class
        ]
    ];
}