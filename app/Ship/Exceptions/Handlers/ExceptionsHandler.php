<?php


namespace App\Ship\Exceptions\Handlers;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Porto\Core\Exceptions\Handlers\CoreExceptionHandler;


class ExceptionsHandler extends CoreExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [];

    public function __construct(Container $container) {
        parent::__construct($container);
        // 处理 optimus.heimdal 配置还没有加载前出现异常问题
        if (!$this->config) {
            $this->config = require __DIR__ . '/../../Configs/optimus.heimdal.php';
        }
    }


    public function report(Exception $exception) {
        if (app()->bound('sentry') && $this->shouldReport($exception)){
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    public function render($request, Exception $exception) {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception) {
        return $request->expectsJson()
            ? response()->json(['error' => 'unauthenticated'], 401)
            : redirect()->guest('login');
    }

}