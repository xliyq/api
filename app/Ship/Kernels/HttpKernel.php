<?php
/**
 * Created by PhpStorm.
 * User: liyq
 * Date: 2019/5/24
 * Time: 16:13
 */

namespace App\Ship\Kernels;

use Porto\Core\Middleware\ProcessETagHeadersMiddleware;
use Illuminate\Foundation\Http\Kernel as LaravelKernel;
use Porto\Core\Middleware\ValidateJsonContent;

/**
 * Class HttpKernel
 *
 * @package Porto\Core\Kernels
 *
 * author liyq <2847895875@qq.com>
 */
class HttpKernel extends LaravelKernel
{

    /**
     * 应用全局中间件
     *
     * @var array
     */
    protected $middleware = [
        // laravel 原生中间件
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Porto\Core\Middleware\TrimStrings::class,
        \Porto\Core\Middleware\TrustProxies::class,

        //跨域中间件
        \Barryvdh\Cors\HandleCors::class

    ];

    /**
     * 应用中间件组
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Porto\Core\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Porto\Core\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
           ValidateJsonContent::class,
            'bindings',
            ProcessETagHeadersMiddleware::class,
        ]
    ];

    /**
     * 应用的路由中间件
     *
     * @var array
     */
    protected $routeMiddleware = [
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'can'      => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth'     => \Porto\Core\Middleware\Authenticate::class,
        'signed'   => \Illuminate\Routing\Middleware\ValidateSignature::class
    ];

}