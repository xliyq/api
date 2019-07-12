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