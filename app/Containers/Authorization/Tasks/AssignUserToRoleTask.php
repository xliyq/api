<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\User\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Porto\Core\Tasks\CoreTask;

/**
 * Class AssignUserToRoleTask
 *
 * 给用户分配role
 *
 * @package App\Containers\Authorization\Tasks
 *
 * author liyq <2847895875@qq.com>
 */
class AssignUserToRoleTask extends CoreTask
{

    public function run(User $user, array $roles): Authenticatable {
        return $user->assignRole($roles);
    }
}
