<?php


namespace App\Containers\User\UI\API\Tests;


use App\Containers\User\Tests\ApiTestCase;

class ResetPasswordTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/password/reset';

    protected $access = [
        'permissions' => '',
        'roles'       => ''
    ];

    public function testResetPassword() {
        $data = [
            'password' => '123456',
        ];

        $user = $this->getTestingUser();
        $response = $this->makeCall(['phone' => $user->phone] + $data);

        $response->assertStatus(204);
    }
}