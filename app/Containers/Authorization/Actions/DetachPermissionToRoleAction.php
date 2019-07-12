<?php


namespace App\Containers\Authorization\Actions;


use App\Containers\Authorization\Models\Role;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class DetachPermissionToRoleAction extends CoreAction
{
    public function run(DataDto $data): Role {
        $role = Porto::call('Authorization@FindRoleTask', [$data->role_id]);

        $role = Porto::call('Authorization@DetachPermissionsFromRoleTask', [
            $role,
            $data->permissions_ids
        ]);

        return $role;
    }
}