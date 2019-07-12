<?php


namespace App\Containers\User\UI\API\Tests;


use App\Containers\User\Models\User;
use App\Containers\User\Tests\ApiTestCase;

class DeleteUserTest extends ApiTestCase
{
    protected $endpoint = 'delete@api/v1/users/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'delete-users'
    ];

    /**
     * 删除已存在的用户(删除自己)
     */
    public function testDeleteExistingUser() {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->makeCall();

        // 断言状态码为成功
        $response->assertStatus(204);
    }

    /**
     * 删除其他已存在的用户
     */
    public function testDeleteAnotherExistingUser() {
        // 创建一个空权限的用户
        $this->getTestingUserWithoutAccess();

        $anotherUser = factory(User::class)->create();

        $response = $this->injectId($anotherUser->id)->makeCall();

        $response->assertStatus(403);
    }
}