<?php


namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Models\Role;
use Porto\Core\Support\Facades\Porto;
use Porto\Core\Tasks\CoreTask;

class DetachPermissionsFromRoleTask extends CoreTask
{

    /**
     * @param Role $role
     * @param      $singleOrMultiplePermissionIds
     *
     * @return Role
     */
    public function run(Role $role, $singleOrMultiplePermissionIds): Role {
        if (!is_array($singleOrMultiplePermissionIds)) {
            $singleOrMultiplePermissionIds = [$singleOrMultiplePermissionIds];
        }

        array_map(function ($permissionId) use ($role) {
            $permission = Porto::call('Authorization@FindPermissionTask', [$permissionId]);
            // 删除权限
            $role->revokePermissionTo($permission);
        }, $singleOrMultiplePermissionIds);

        return $role;
    }
}