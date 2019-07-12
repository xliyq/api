<?php


namespace App\Containers\Authorization\UI\API\Tests\Permissions;


use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;

class DetachPermissionToRoleTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/permissions/detach';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];


    public function testDetachSinglePermissionsFromRole() {
        $permission = factory(Permission::class)->create();

        $role = factory(Role::class)->create();
        $role->givePermissionTo($permission);

        $data = [
            'role_id'         => $role->id,
            'permissions_ids' => [$permission->id]
        ];
        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertJsonFragment($role->only(['id', 'name']));

        $table = config('permission.table_names.role_has_permissions');
        $this->assertDatabaseMissing($table, [
            'permission_id' => $permission->id,
            'role_id'       => $role->id
        ]);
    }

    public function testDetachMultiplePermissionsFromRole() {
        $permissionA = factory(Permission::class)->create();
        $permissionB = factory(Permission::class)->create();

        $role = factory(Role::class)->create();
        $role->givePermissionTo($permissionA);
        $role->givePermissionTo($permissionB);

        $data = [
            'role_id'         => $role->id,
            'permissions_ids' => [$permissionA->id, $permissionB->id]
        ];
        $response = $this->makeCall($data);

        $response->assertStatus(200);

        $response->assertJsonFragment($role->only(['id', 'name']));

        //断言删除的数据已经不在数据库中
        $table = config('permission.table_names.role_has_permissions');
        $this->assertDatabaseMissing($table, [
            'permission_id' => $permissionA->id,
            'role_id'       => $role->id
        ]);
        $this->assertDatabaseMissing($table, [
            'permission_id' => $permissionB->id,
            'role_id'       => $role->id
        ]);
    }
}