<?php


namespace App\Containers\User\Actions;


use App\Containers\User\Models\User;
use Porto\Core\Actions\CoreAction;
use Porto\Core\Exceptions\NotFoundException;
use Porto\Core\Support\Facades\Porto;

class GetAuthenticatedUserAction extends CoreAction
{
    public function run(): User {
        $user = Porto::call('Authentication@GetAuthenticatedUserTask');

        if (!$user) {
            throw new NotFoundException();
        }
        return $user;
    }
}