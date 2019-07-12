<?php


namespace App\Containers\Authorization\Actions;


use App\Containers\Authorization\Models\Role;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class CreateRoleAction extends CoreAction
{
    public function run(DataDto $data): Role {
        $role = Porto::call('Authorization@CreateRoleTask', [
            $data->name,
            $data->display_name,
            $data->description
        ]);

        return $role;
    }
}