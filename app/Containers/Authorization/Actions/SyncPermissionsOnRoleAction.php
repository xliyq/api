<?php


namespace App\Containers\Authorization\Actions;


use App\Containers\Authorization\Models\Role;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class SyncPermissionsOnRoleAction extends CoreAction
{
    public function run(DataDto $data): Role {
        $role = Porto::call('Authorization@FindRoleTask', [$data->role_id]);

        $permissionIds = (array)$data->permissions_ids;

        $permissions = array_map(function ($permissionId) {
            return Porto::call('Authorization@FindPermissionTask', [$permissionId]);
        }, $permissionIds);

        $role->syncPermissions($permissions);

        return $role;
    }
}