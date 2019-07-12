<?php


namespace App\Containers\Authorization\Data\Seeders;


use Porto\Core\Seeders\CoreSeeders;
use Porto\Core\Support\Facades\Porto;

class AuthorizationPermissionsSeeder_1 extends CoreSeeders
{

    public function run() {
        $permissions = [
            ['manage-roles', '管理角色'],
            ['create-admins', '创建管理员'],
            ['manage-admins-access', '管理用户角色'],
        ];

        foreach ($permissions as $permission) {
            Porto::call('Authorization@CreatePermissionTask', $permission);
        }
    }
}