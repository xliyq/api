<?php


namespace App\Ship\Exceptions\Formatters;


use Illuminate\Support\Facades\Log;
use Porto\Core\Exceptions\Abstracts\CoreExceptionsFormatter;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class ValidationExceptionFormatter
 *
 * @package Porto\Core\Exceptions\Formatters
 *
 * author liyq <2847895875@qq.com>
 */
class ValidationExceptionFormatter extends CoreExceptionsFormatter
{

    /**
     * @var integer
     */
    CONST STATUS_CODE = 422;

    /**
     * @param Exception    $exception
     * @param JsonResponse $response
     *
     * @return array
     */
    function responseData(Exception $exception, JsonResponse $response): array {
        Log::debug('test', request()->toArray());
        return [
            'code'        => $exception->getCode(),
            'message'     => $exception->getMessage(),
            'errors'      => $exception->errors(),
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