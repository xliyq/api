# 数据填充(Seeder)

## 规则
* `Seeder` **必须**  继承`Porto\Core\Seeders\CoreSeeders`
* `Seeder` **必须** 存放在容器中。
* `Seeder` 命名 **应该** 加上容器名，在所用容器中`Seeder`相同名称，即使在不同的容器中，也只会加载一个。
* 如果希望在容器中按照顺序执行`Seeder`，请在文件名后面加上数字标号。如：`_1`、`_2`.

## 目录结构
```text
- app 
    - Containers
        - {container-name}
            - Data
                - Seeders
                    - ContainerNameRolesSeeder_1.php
                    - ContainerNamePermissionsSeeder_2.php
```

## 代码示例
```php
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
```

### 运行Seeder
`php artisan db:seed`
