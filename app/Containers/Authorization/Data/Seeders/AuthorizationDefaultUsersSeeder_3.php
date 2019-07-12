<?php


namespace App\Containers\Authorization\Data\Seeders;


use Porto\Core\Seeders\CoreSeeders;
use Porto\Core\Support\Facades\Porto;

class AuthorizationDefaultUsersSeeder_3 extends CoreSeeders
{
    public function run() {
        // 创建管理员用户
        Porto::call('User@CreateUserByCredentialsTask', [
            '15871450000',
            '123456',
            '系统管理员'
        ])->assignRole(Porto::call('Authorization@FindRoleTask', ['admin']));
    }
}