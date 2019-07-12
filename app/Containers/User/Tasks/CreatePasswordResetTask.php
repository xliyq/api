<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Models\User;
use Porto\Core\Tasks\CoreTask;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class CreatePasswordResetTask extends CoreTask
{
    public function run(User $user) {
        try {
            return app('auth.password.broker')->createToken($user);
        } catch (\Exception $exception) {
            throw new InternalErrorException();
        }
    }
}
