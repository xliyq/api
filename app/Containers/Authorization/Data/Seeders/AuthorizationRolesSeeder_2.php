<?php


namespace App\Containers\Authorization\Data\Seeders;


use Porto\Core\Seeders\CoreSeeders;
use Porto\Core\Support\Facades\Porto;

class AuthorizationRolesSeeder_2 extends CoreSeeders
{

    public function run() {
        $roles = [
            ['admin', '管理员'],
            ['teacher', '老师'],
            ['student', '学生'],
        ];

        foreach ($roles as $role) {
            Porto::call('Authorization@CreateRoleTask', $role);
        }
    }
}