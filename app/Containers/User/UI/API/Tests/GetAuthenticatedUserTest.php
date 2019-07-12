<?php


namespace App\Containers\User\UI\API\Tests;


use App\Containers\User\Tests\ApiTestCase;

class GetAuthenticatedUserTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/user/profile';

    protected $access = [
        'permissions' => '',
        'roles'       => ''
    ];


    /**
     * 常规测试
     */
    public function testGetAuthenticatedUser() {
        $user = $this->getTestingUser();

        $response = $this->makeCall();

        $response->assertStatus(200);

        $response->assertJsonFragment($user->only(['id', 'name', 'phone']));
    }
}