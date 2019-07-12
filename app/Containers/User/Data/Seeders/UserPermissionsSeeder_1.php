<?php


namespace App\Containers\User\Data\Seeders;


use Porto\Core\Seeders\CoreSeeders;
use Porto\Core\Support\Facades\Porto;

class UserPermissionsSeeder_1 extends CoreSeeders
{
    public function run() {
        $permissions = [
            ['search-users', '搜索用户'],
            ['list-users', '获取所有用户'],
            ['update-users', '更新用户'],
            ['delete-users', '删除用户'],
            ['refresh-users', '刷新用户'],
        ];

        foreach ($permissions as $permission) {
            Porto::call('Authorization@CreatePermissionTask', $permission);
        }
    }
}