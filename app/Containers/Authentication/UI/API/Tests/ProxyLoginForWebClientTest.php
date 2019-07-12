<?php


namespace App\Containers\Authentication\UI\API\Tests;

use App\Containers\Authentication\Tests\ApiTestCase;

class ProxyLoginForWebClientTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/clients/web/login';

    protected $access = [];

    public function testProxyLoginForWebClient() {
        $data = [
            'phone'    => '15871450000',
            'password' => '123456'
        ];
        $response = $this->makeCall($data);

        $response->assertStatus(200);

        //包含token信息
        $response->assertJsonStructure(['access_token', 'refresh_token']);
    }

}