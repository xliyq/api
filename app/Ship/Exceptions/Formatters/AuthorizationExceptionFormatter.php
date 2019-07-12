<?php


namespace App\Ship\Exceptions\Formatters;


use Porto\Core\Exceptions\Abstracts\CoreExceptionsFormatter;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthorizationExceptionFormatter extends CoreExceptionsFormatter
{
    const STATUS_CODE = 403;

    /**
     * @param Exception    $exception
     * @param JsonResponse $response
     *
     * @return array
     */
    function responseData(Exception $exception, JsonResponse $response): array {
        return [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'errors' => '您无权访问此资源！',
            'status_code' => self::STATUS_CODE
        ];
    }

    /**
     * @param Exception    $exception
     * @param JsonResponse $response
     *
     * @return JsonResponse
     */
    function modifyResponse(Exception $exception, JsonResponse $response): JsonResponse {
        return $response;
    }

    /**
     * @return int
     */
    function statusCode(): int {
        return self::STATUS_CODE;
    }
}