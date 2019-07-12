<?php


namespace App\Containers\Authorization\UI\API\Tests\Roles;


use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;
use App\Containers\User\Models\User;

class SyncUserRoleTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/roles/sync?include=roles';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testSyncUserRole() {
        $roles = factory(Role::class, 3)->create();
        $role = $roles->first();
        $user = factory(User::class, 1)
            ->create()
            ->each(function (User $user) use ($role) {
                $user->assignRole($role);
            })
            ->first();
        $roleIds = $roles
            ->pluck('id')
            ->filter(function ($id) use ($role) {
                return $id <> $role->id;
            })
            ->sort()
            ->all();
        $data = [
            'user_id'   => $user->id,
            'roles_ids' => $roleIds
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);

        $res_role_ids = $response->decodeResponseJson('data.roles');
        $res_role_ids = collect($res_role_ids)->pluck('id')->sort()->all();
        config('permission.table_names.role_has_permissions');

        // 因$roleIds的值有是通过移除元素得到的，键值顺序不对
        $this->assertEquals($res_role_ids, array_values($roleIds));

    }

}