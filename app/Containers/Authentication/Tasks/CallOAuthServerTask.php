<?php


namespace App\Containers\Authentication\Tasks;


use App\Containers\Authentication\Exceptions\LoginFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Porto\Core\Tasks\CoreTask;

/**
 * Class CallOAuthServerTask
 *
 * 调用OAuth 认证接口
 *
 * @package App\Containers\Authentication\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class CallOAuthServerTask extends CoreTask
{
    // 认证路由地址
    CONST AUTH_ROUTE = '/api/v1/oauth/token';

    public function run($data) {
        $authFullApiUrl = Config::get('porto.api.url') . self::AUTH_ROUTE;
        $headers = ['HTTP_ACCPET' => 'application/json'];

        $request = Request::create($authFullApiUrl, 'POST', $data, [], [], $headers);
        $response = App::handle($request);

        $content = json_decode($response->getContent(), true);

        if (!$response->isSuccessful()) {
            throw new LoginFailedException($content['message'], null, $response->getStatusCode());
        }
        return $content;
    }
}