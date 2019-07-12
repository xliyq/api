<?php


namespace App\Containers\Debugger\Middlewares;


use App\Containers\Debugger\Output;
use App\Containers\Debugger\Logger;
use Illuminate\Http\Request;
use Porto\Core\Middleware\AbstractMiddleware;

class RequestMonitorMiddleware extends AbstractMiddleware
{

    public function handle(Request $request, \Closure $next) {
        $response = $next($request);

        $output = new Output($request, $response);

        $output->newRequest();
        $output->spaceLine();

        $output->header("REQUEST INFO");
        $output->endpoint();
        $output->version();
        $output->ip();
        $output->format();
        $output->spaceLine();

        $output->header("USER INFO");
        $output->userInfo();
        $output->spaceLine();

        $output->header("REQUEST DATA");
        $output->requestData();
        $output->spaceLine();

        $output->header("RESPONSE DATA");
        $output->responseData();
        $output->spaceLine();

        (new Logger(Logger::REQUEST))->releaseOutput($output);

        return $response;
    }
}