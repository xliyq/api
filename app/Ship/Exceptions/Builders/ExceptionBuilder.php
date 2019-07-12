<?php


namespace App\Ship\Exceptions\Builders;


use Illuminate\Http\JsonResponse;

/**
 * Class ExceptionBuilder
 *
 * @package Porto\Core\Exceptions\Builders
 *
 * author liyq <2847895875@qq.com>
 */
class ExceptionBuilder
{
    /**
     * @param \Exception $exception
     *
     * @return JsonResponse
     */
    public static function make(\Exception $exception) {
        return new JsonResponse([
            'status' => 'error'
        ]);
    }
}