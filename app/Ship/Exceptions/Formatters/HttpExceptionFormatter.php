<?php


namespace App\Ship\Exceptions\Formatters;


use Porto\Core\Exceptions\Abstracts\CoreExceptionsFormatter;
use Exception;
use Illuminate\Http\JsonResponse;

class HttpExceptionFormatter extends CoreExceptionsFormatter
{
    public $statusCode;

    /**
     * @param Exception    $exception
     * @param JsonResponse $response
     *
     * @return array
     */
    function responseData(Exception $exception, JsonResponse $response): array {
        $this->statusCode = $exception->getStatusCode();
        return [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'status_code' => $this->statusCode
        ];
    }

    /**
     * @param Exception    $exception
     * @param JsonResponse $response
     *
     * @return JsonResponse
     */
    function modifyResponse(Exception $exception, JsonResponse $response): JsonResponse {
        if (count($headers = $exception->getHeaders())) {
            $response->headers->add($headers);
        }
        return $response;
    }

    /**
     * @return int
     */
    function statusCode(): int {
        return $this->statusCode;
    }
}