<?php


namespace App\Containers\Authentication\UI\API\Controllers;


use App\Containers\Authentication\UI\API\Requests\LoginRequest;
use App\Containers\Authentication\UI\API\Requests\LogoutRequest;
use App\Containers\Authentication\UI\API\Requests\RefreshRequest;
use App\Containers\Authentication\UI\API\Resource\LoginResource;
use Illuminate\Support\Facades\Cookie;
use Porto\Core\Dto\DataDto;
use Porto\Core\Http\Controllers\ApiController;
use Porto\Core\Support\Facades\Porto;

class Controller extends ApiController
{

    public function logout(LogoutRequest $request) {
        $data = new DataDto($request);
        $data->bearerToken = $request->bearerToken();

        Porto::call('Authentication@ApiLogoutAction', [$data]);

        return $this->accepted([
            'message' => '退出成功'
        ])->withCookie(Cookie::forget('refreshToken'));
    }

    public function proxyLoginForWebClient(LoginRequest $request) {
        $data = new DataDto(array_merge($request->all(), [
            'client_id'       => config('authentication.clients.web.id'),
            'client_password' => config('authentication.clients.web.secret')
        ]));
        $result = Porto::call('Authentication@ProxyApiLoginAction', [$data]);

        return new LoginResource($result);
//        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }

    public function proxyRefreshForWebClient(RefreshRequest $request) {
        $data = new DataDto(array_merge($request->all(), [
            'client_id'       => config('authentication.clients.web.id'),
            'client_password' => config('authentication.clients.web.secret'),
            'refresh_token'   => $request->refresh_token ?: $request->cookie('refreshToken')
        ]));

        $result = Porto::call('Authentication@ProxyApiRefreshAction', [$data]);

        return new LoginResource($result);
//        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }

}