<?php


namespace App\Containers\Authorization\Actions;


use App\Containers\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\Authorization\Models\Permission;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class FindPermissionAction extends CoreAction
{
    public function run(DataDto $data): Permission {
        $permission = Porto::call('Authorization@FindPermissionTask', [$data->id]);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }
        return $permission;
    }
}