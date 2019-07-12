<?php


namespace App\Containers\Authorization\Actions;


use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Authorization\Models\Role;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class FindRoleAction extends CoreAction
{
    public function run(DataDto $data): Role {
        $role = Porto::call('Authorization@FindRoleTask', [$data->id]);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }
}