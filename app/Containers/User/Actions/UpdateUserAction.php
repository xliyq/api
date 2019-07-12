<?php


namespace App\Containers\User\Actions;


use App\Containers\User\Models\User;
use Porto\Core\Dto\DataDto;
use Illuminate\Support\Facades\Hash;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Support\Facades\Porto;

class UpdateUserAction extends CoreAction
{
    public function run(DataDto $data): User {
        $userData = [
            'password' => $data->password ? Hash::make($data->password) : null,
            'name'     => $data->name,
            'phone'    => $data->phone,
        ];

        $userData = array_filter($userData);
        $user = Porto::call('User@UpdateUserTask', [$userData, $data->id]);
        return $user;
    }
}