<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\User\Models\User;
use Porto\Core\Tasks\CoreTask;

class ApiLoginFromUserTask extends CoreTask
{

    public function run(User $user) {
        $personalAccessTokenResult = $user->createToken('social');
        return $personalAccessTokenResult;
    }
}
