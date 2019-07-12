<?php


namespace App\Containers\User\UI\API\Tests;


use App\Containers\User\Tests\ApiTestCase;

class ForgotPasswordTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/password/forgot';

    protected $access = [
        'permissions' => '',
        'roles'       => ''
    ];

    /**
     * 测试忘记密码
     */
    public function testForgotPassword() {
        $user = $this->getTestingUser();
        $response = $this->makeCall(['phone' => $user['phone']]);

        $response->assertStatus(204);
    }

    /**
     * 测试忘记密码-用户不存在
     */
    public function testForgotPasswordNonExistingUser() {
        $response = $this->makeCall(['phone' => '12345678901']);

        $response->assertStatus(404);
    }
}