<?php


namespace App\Containers\Authentication\UI\API\Tests;


use App\Containers\Authentication\Tests\ApiTestCase;

class LogoutTest extends ApiTestCase
{
    protected $endpoint = 'delete@api/v1/logout';
    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testLogout() {
        $response = $this->makeCall();

        $response->assertStatus(202);
    }
}