<?php


namespace App\Containers\User\UI\API\Tests;


use App\Containers\User\Models\User;
use App\Containers\User\Tests\ApiTestCase;

class GetAllAdminsTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/admins';

    protected $access = [
        'roles'       => '',
        'permissions' => 'list-users',
    ];

    /**
     * 获取管理员用户列表
     */
    public function testGetAllAdmins() {
        // 创建2个管理员账号
        $users = factory(User::class, 2)->create()->each(function (User $user) {
            $user->assignRole('admin');
        });

        // 创建2个无角色的用户，该请求不应该返回
        factory(User::class, 2)->create();

        $response = $this->makeCall();

        $response->assertStatus(200);
        // 1个超级管理员
        $response->assertJsonCount(count($users) + 1, 'data');
    }

    /**
     * 非管理员获取管理员列表
     */
    public function testGetAllAdminsByNonAdmin() {
        $this->getTestingUserWithoutAccess();

        factory(User::class, 2)->create()->each(function (User $user) {
            $user->assignRole('admin');
        });

        $response = $this->makeCall();

        $response->assertStatus(403);
    }
}