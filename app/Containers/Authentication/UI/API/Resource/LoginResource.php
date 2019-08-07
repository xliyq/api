<?php


namespace App\Containers\Authentication\UI\API\Resource;


use Porto\Core\Resources\CoreResource;

class LoginResource extends CoreResource
{
    public function toArray($request) {
        return [
            'token_type'    => $this->resource['response_content']['token_type'],
            'expires_in'    => $this->resource['response_content']['expires_in'],
            'access_token'  => $this->resource['response_content']['access_token'],
            'refresh_token' => $this->resource['response_content']['refresh_token']
        ];
    }

    public function withResponse($request, $response) {
        $response->withCookie($this->resource['refresh_cookie']);
    }
}