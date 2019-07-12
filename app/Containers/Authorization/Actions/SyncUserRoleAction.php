<?php


namespace App\Containers\Authorization\Actions;


use App\Containers\User\Models\User;
use Porto\Core\Dto\DataDto;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Support\Facades\Porto;

class SyncUserRoleAction extends CoreAction
{

    public function run(DataDto $data) {
        /**
         * @var User
         */
        $user = Porto::call('User@FindUserByIdTask', [$data->user_id]);

        $roleIds = (array)$data->roles_ids;

        $roles = array_map(function ($roleId) {
            return Porto::call('Authorization@FindRoleTask', [$roleId]);
        }, $roleIds);

        $user->syncRoles($roles);
        return $user;
    }
}