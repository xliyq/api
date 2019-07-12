<?php


namespace App\Containers\Authorization\Providers;


use Porto\Core\Providers\Abstracts\CoreMiddlewareProvider;

class MiddlewareServiceProvider extends CoreMiddlewareProvider
{

    protected $middlewares = [];

    protected $middlewareGroups = [];

    protected $routeMiddleware = [
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class
    ];
}