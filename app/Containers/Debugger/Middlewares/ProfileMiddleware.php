<?php


namespace App\Containers\Debugger\Middlewares;


use Illuminate\Http\JsonResponse;
use Porto\Core\Middleware\AbstractMiddleware;

class ProfileMiddleware extends AbstractMiddleware
{
    public function handle($request, \Closure $next) {
        $response = $next($request);

        if (!config('debugbar.enabled')) {
            return $response;
        }

        if ($response instanceof JsonResponse && app()->bound('debugbar')) {
            $profileData = ['_profile' => app('debugbar')->getData()];
            $response->setData($response->getData(true) + $profileData);
        }
        return $response;
    }
}