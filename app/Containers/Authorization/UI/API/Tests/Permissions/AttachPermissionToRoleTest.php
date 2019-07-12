<?php


namespace App\Containers\Authorization\UI\API\Tests\Permissions;


use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;

class AttachPermissionToRoleTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/permissions/attach';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testAttachSinglePermissionToRole() {
        $role = factory(Role::class)->create();

        $permissions = factory(Permission::class)->create();

        $data = [
            'role_id'         => $role->id,
            'permissions_ids' => $permissions->id
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);

        $response->assertJsonFragment($role->only(['id', 'name']));

        $this->assertDatabaseHas('role_has_permissions', [
            'permission_id' => $permissions->id,
            'role_id'       => $role->id
        ]);
    }

    public function testAttachMultiplePermissionToRole() {
        $role = factory(Role::class)->create();

        $permissionA = factory(Permission::class)->create();
        $permissionB = factory(Permission::class)->create();

        $data = [
            'role_id'         => $role->id,
            'permissions_ids' => [$permissionA->id, $permissionB->id]
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);

        $response->assertJsonFragment($role->only(['id', 'name']));

        $table = config('permission.table_names.role_has_permissions');
        $this->assertDatabaseHas($table, [
            'permission_id' => $permissionA->id,
            'role_id'       => $role->id
        ]);
        $this->assertDatabaseHas($table, [
            'permission_id' => $permissionB->id,
            'role_id'       => $role->id
        ]);
    }
}