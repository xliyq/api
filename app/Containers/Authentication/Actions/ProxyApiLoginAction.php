<?php


namespace App\Containers\Authentication\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class ProxyApiLoginAction extends CoreAction
{
    public function run(DataDto $data): array {
        $requestData = [
            'grant_type'    => $data->grant_type ?? 'password',
            'client_id'     => $data->client_id,
            'client_secret' => $data->client_password,
            'password'      => $data->password,
            'scope'         => $data->scope ?? '',
        ];

        $prefix = config('authentication.login.prefix', '');
        $allowedLoginFields = config('authentication.login.allowed_login_attributes', ['phone' => []]);
        $fields = array_keys($allowedLoginFields);

        $loginUsername = null;
        $loginAttribute = null;

        foreach ($fields as $field) {
            $fieldName = $prefix . $field;
            $loginUsername = $data->getInputByKey($fieldName);
            $loginAttribute = $field;
            if ($loginUsername !== null) {
                break;
            }
        }

        $requestData = array_merge($requestData, [
            'username' => $loginUsername
        ]);

        //调用Oauth 认证
        $responseContent = Porto::call('Authentication@CallOAuthServerTask', [$requestData]);

        //组装refreshCookie
        $refreshCookie = Porto::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie'   => $refreshCookie
        ];
    }
}