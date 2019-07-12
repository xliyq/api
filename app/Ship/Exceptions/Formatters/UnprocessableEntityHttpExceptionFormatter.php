<?php


namespace App\Ship\Exceptions\Formatters;


use Porto\Core\Exceptions\Abstracts\CoreExceptionsFormatter;
use Exception;
use Illuminate\Http\JsonResponse;

class UnprocessableEntityHttpExceptionFormatter extends CoreExceptionsFormatter
{

    CONST STATUS_CODE = 422;

    /**
     * @param Exception    $exception
     * @param JsonResponse $response
     *
     * @return array
     */
    function responseData(Exception $exception, JsonResponse $response): array {
        // laravel的验证错误返回json字符串
        $decoded = json_decode($exception->getMessage(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $decoded = [[$exception->getMessage()]];
        }

        $errors = array_reduce($decoded, function ($carry, $item) use ($exception) {
            return array_merge($carry, array_map(function ($current) use ($exception) {
                return [
                    'status' => self::STATUS_CODE,
                    'code' => $exception->getCode(),
                    'title' => '验证错误',
                    'detail' => $current
                ];
            }, $item));
        }, []);

        return [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'errors' => $errors
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