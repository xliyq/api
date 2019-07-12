<?php


namespace App\Containers\Authorization\Actions;


use App\Containers\User\Models\User;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class AssignUserToRoleAction extends CoreAction
{
    public function run(DataDto $data): User {
        $user = Porto::call('User@FindUserByIdTask', [$data->user_id]);

        $rolesIds = (array)$data->roles_ids;

        $roles = array_map(function ($roleId) {
            return Porto::call('Authorization@FindRoleTask', [$roleId]);
        }, $rolesIds);

        $user = Porto::call('Authorization@AssignUserToRoleTask', [$user, $roles]);

        return $user;
    }
}