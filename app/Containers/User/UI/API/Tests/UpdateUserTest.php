<?php


namespace App\Containers\User\UI\API\Tests;


use App\Containers\User\Tests\ApiTestCase;

class UpdateUserTest extends ApiTestCase
{
    protected $endpoint = 'put@api/v1/users/{id}';

    protected $access = [
        'permissions' => 'update-users',
        'roles'       => '',
    ];

    /**
     * 测试更新存在的用户
     */
    public function testUpdateExistingUser() {
        $user = $this->getTestingUser();
        $data = [
            'name'     => 'Updated Name',
            'password' => 'update password',
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'phone' => $user->phone,
            'name'  => $data['name'],
        ]);

        $this->assertDatabaseHas('users', ['name' => $data['name']]);

    }

    /**
     * 测试更新不存在的用户
     */
    public function testUpdateNonExistingUser() {
        $data = [
            'name' => 'updated Name'
        ];

        $user_id = 7777;
        $response = $this->injectId($user_id)->makeCall($data);

        $response->assertStatus(422);

        $response->assertJsonFragment([
            'status' => 'error'
        ]);
    }

    /**
     * 测试更新不传参数
     */
    public function testUpdateExistingUserWithoutData() {
        $response = $this->makeCall();

        $response->assertStatus(422);

        $response->assertJsonFragment([
            'message' => 'The given data was invalid.'
        ]);
    }

    /**
     * 测试更新时传递空数据
     */
    public function testUpdateExistingUserWithEmptyValues() {
        $data = [
            'name'     => '',
            'password' => ''
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors([
            'password' => '密码 至少为 6 个字符。'
        ]);
    }
}