<?php


namespace App\Containers\Authorization\Actions;


use App\Containers\User\Models\User;
use Illuminate\Support\Collection;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Dto\DataDto;
use Porto\Core\Support\Facades\Porto;

class RevokeRoleFromUserAction extends CoreAction
{
    public function run(DataDto $data): User {
        if (!$data->user_id instanceof User) {
            $user = Porto::call('User@FindUserByIdTask', [$data->user_id]);
        } else {
            $user = $data->user_id;
        }
        $rolesIds = (array)$data->roles_ids;

        $roles = new Collection();
        foreach ($rolesIds as $roleId) {
            $role = Porto::call('Authorization@FindRoleTask', [$roleId]);
            $roles->add($role);
        }

        foreach ($roles as $role) {
            $user->removeRole($role);
        }
        return $user;
    }
}