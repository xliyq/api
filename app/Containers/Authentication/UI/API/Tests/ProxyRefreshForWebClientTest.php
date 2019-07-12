<?php


namespace App\Containers\Authentication\UI\API\Tests;


use App\Containers\Authentication\Tests\ApiTestCase;

class ProxyRefreshForWebClientTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/clients/web/refresh';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testProxyRefreshForWebClient() {

        $loginResponse = $this->endpoint('post@api/v1/clients/web/login')->makeCall([
            'phone'    => '15871450000',
            'password' => '123456'
        ]);

        $loginResponse->assertStatus(200);

        $refreshToken = $this->getResponseContentObject()->refresh_token;
        $this->overrideEndpoint = null;
        $response = $this->makeCall(['refresh_token' => $refreshToken]);

        $response->assertStatus(200);
        //包含token信息
        $response->assertJsonStructure(['access_token', 'refresh_token']);
    }
}