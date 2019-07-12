# 中间件

## 定义
中间件提供了一种方便的机制来过滤进入应用程序的HTTP请求。更多关于他们的信息。

您可以根据需要启用和禁用中间件。

## 规则
* 中间件可以放在`Ship`层中，或者`Container`层取决于它们的角色。
* 如果中间件写在`Container`中，它必须在该`Container`内注册。
* 要在容器中注册中间件，容器需要有一个`MiddlewareServiceProvider`。和所有其他Container Providers一样，它必须在该`MainServiceProviderContainer`中注册。
* 一般中间件（如某些默认的Laravel Middleware）应该存在于Ship层`app/Ship/Middlewares/*`，并在Ship Main Provider中注册。
* 第三方软件包中间件可以在容器中或在Ship层上注册。


## 文件夹结构
```text
 - App
   - Containers
       - {container-name}
           - Middlewares
              - WebAuthentication.php
   - Ship
       - Middleware
          - Http
             - EncryptCookies.php
             - VerifyCsrfToken.php
```

## 代码示例
```php
<?php

namespace App\Containers\Debugger\Middlewares;

use App\Containers\Debugger\Logger;
use Porto\Core\Middleware\AbstractMiddleware;

class RunningTimeMiddleware extends AbstractMiddleware
{
    public function handle($request, \Closure $next) {
        $response = $next($request);

        if (!app()->runningInConsole()) {
            $log = [
                'time'   => round(microtime(true) - LARAVEL_START, 2),
                'path'   => $request->path(),
                'params' => json_encode($request->all(), JSON_UNESCAPED_UNICODE),
            ];
            (new Logger(Logger::RUNNING))->releaseRunningTime($log);
        }

        return $response;
    }
}
```

### 在容器中注册中间件
```php
<?php

class MiddlewareServiceProvider extends \Porto\Core\Providers\Abstracts\CoreMiddlewareProvider {
    protected $middleware = [
        RunningTimeMiddleware::class,
    ];
    
    protected $middlewareGroups = [
        'web' => [

        ],
        'api' => [

        ],
    ];
    
    protected $routeMiddleware = [
    ];

    
}
```
### 在Ship中注册中间件 (Kernel)
```php
<?php
class HttpKernel extends LaravelKernel{
      protected $middleware = [];
      
      protected $middlewareGroups = [
          'web' => [
  
          ],
          'api' => [
  
          ],
      ];
          
      protected $routeMiddleware = [
      ];
}
```