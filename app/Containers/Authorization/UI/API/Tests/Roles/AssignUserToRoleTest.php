<?php


namespace App\Containers\Authorization\UI\API\Tests\Roles;


use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;
use App\Containers\User\Models\User;

class AssignUserToRoleTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/roles/assign?include=roles';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 使用已存在的数据测试
     */
    public function testAssignUserToRole() {
        $user = factory(User::class, 1)->create()->first();
        $roles = factory(Role::class, 2)->create();


        $data = [
            'user_id'   => $user->id,
            'roles_ids' => $roles->pluck('id')->all()
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);

        //验证角色是否设置成功
        $role = $response->decodeResponseJson('data.roles');
        $role = collect($role)->pluck('id')->all();
        $this->assertArrayContain($roles->pluck('id')->all(), $role);
    }

    /**
     * 测试角色存在，用户不存在
     */
    public function testAssignNonExistingUserToRole() {
        $roles = factory(Role::class, 2)->create();

        $fakeUserId = 1000;

        $data = [
            'user_id'   => $fakeUserId,
            'roles_ids' => $roles->pluck('id')->all()
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
    }

    /**
     * 测试用户色存在，角不存在
     */
    public function testAssignUserToNonExistingRole() {
        $user = factory(User::class, 1)->create()->first();

        $fakeRoleIds = [$this->faker->numberBetween(1000, 9999)];

        $data = [
            'user_id'   => $user->id,
            'roles_ids' => $fakeRoleIds
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
    }
}