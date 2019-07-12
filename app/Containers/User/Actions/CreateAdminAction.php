<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Models\User;
use Porto\Core\Dto\DataDto;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Support\Facades\Porto;

class CreateAdminAction extends CoreAction
{
    public function run(DataDto $data): User {
//        dd($data, [
//            $data->phone,
//            $data->password,
//            $data->name,
//        ]);
        $admin = Porto::call('User@CreateUserByCredentialsTask', [
            $data->phone,
            $data->password,
            $data->name,
        ]);

        Porto::call('Authorization@AssignUserToRoleTask', [$admin, ['admin']]);
        return $admin;
    }
}
