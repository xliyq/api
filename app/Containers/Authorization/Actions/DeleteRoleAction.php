<?php


namespace App\Containers\Authorization\Actions;


use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class DeleteRoleAction extends CoreAction
{
    public function run(DataDto $data) {
        $role = Porto::call('Authorization@FindRoleTask', [$data->id]);

        Porto::call('Authorization@DeleteRoleTask', [$role]);

        return $role;
    }
}