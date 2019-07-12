<?php


namespace App\Containers\User\Actions;


use App\Containers\User\Models\User;
use Porto\Core\Dto\DataDto;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Support\Facades\Porto;

class FindUserByIdAction extends CoreAction
{
    public function run(DataDto $data): User {
        $user = Porto::call('User@FindUserByIdTask', [$data->id]);
        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }
}