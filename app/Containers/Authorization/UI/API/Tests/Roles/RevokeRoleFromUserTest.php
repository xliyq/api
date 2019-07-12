<?php


namespace App\Containers\Authorization\UI\API\Tests\Roles;


use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;
use App\Containers\User\Models\User;

class RevokeRoleFromUserTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/roles/revoke';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 使用已存在的数据测试
     */
    public function testRevokeRoleFromUser() {
        $roles = factory(Role::class, 2)->create();
        $role = $roles->first();
        $user = factory(User::class, 1)->create()->each(function (User $user) use ($roles) {
            $user->assignRole($roles);
        })->first();

        $data = [
            'user_id'   => $user->id,
            'roles_ids' => [$role->id]
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);

        // 断言数据库中不存在刚刚已删除的信息
        $this->assertDatabaseMissing('model_has_roles', [
            'model_id' => $user->id,
            'role_id'  => $role->id
        ]);

    }


    public function testRevokeNonExistingRoleFromUser() {
        $roles = factory(Role::class, 1)->create();
        $user = factory(User::class, 1)->create()->each(function (User $user) use ($roles) {
            $user->assignRole($roles);
        })->first();

        $data = [
            'user_id'   => $user->id,
            'roles_ids' => [$this->faker->numberBetween(1000, 9999)]
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
    }

    public function testRevokeRoleFromNonExistingUser() {
        $role = factory(Role::class, 1)->create()->first();

        $data = [
            'user_id'   => $this->faker->numberBetween(1000, 9999),
            'roles_ids' => [$role->id]
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(422);
    }
}