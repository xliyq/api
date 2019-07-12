<?php


namespace App\Containers\Authorization\UI\API\Tests\Permissions;


use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;

class SyncPermissionsOnRoleTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/permissions/sync';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testSyncPermissionsToRole() {
        $permissionA = factory(Permission::class)->create();
        $permissionB = factory(Permission::class)->create();
        $permissionC = factory(Permission::class)->create();

        $role = factory(Role::class)->create();
        $role->givePermissionTo($permissionC);

        $data = [
            'role_id'         => $role->id,
            'permissions_ids' => [$permissionA->id, $permissionB->id]
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);

        $response->assertJsonFragment($role->only(['id', 'name']));

        $table = config('permission.table_names.role_has_permissions');
        $this->assertDatabaseMissing($table, [
            'permission_id' => $permissionC->id,
            'role_id'       => $role->id
        ]);
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