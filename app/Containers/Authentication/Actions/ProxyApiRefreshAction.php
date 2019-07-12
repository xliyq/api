<?php


namespace App\Containers\Authentication\Actions;


use App\Containers\Authentication\Exceptions\RefreshTokenMissedException;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class ProxyApiRefreshAction extends CoreAction
{
    public function run(DataDto $data): array {
        if (!$data->refresh_token) {
            throw new RefreshTokenMissedException();
        }

        $requestData = [
            'grant_type'    => $data->grant_type ?? 'refresh_token',
            'refresh_token' => $data->refresh_token,
            'client_id'     => $data->client_id,
            'client_secret' => $data->client_password,
            'scope'         => $data->scope ?? '',
        ];

        $responseContent = Porto::call('Authentication@CallOAuthServerTask', [$requestData]);
        $refreshCookie = Porto::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie'   => $refreshCookie,
        ];
    }
}