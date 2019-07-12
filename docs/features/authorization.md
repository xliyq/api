# 授权

在`Authorization`容器中通过[`laravel-permimssion`](https://packagist.org/packages/spatie/laravel-permission)
第三方扩展提供了基于角色的访问控制（RBAC），您可以参考其相应的文档了解更多信息。

## 工作方式

1. 首先需要有一个超级管理员、一个管理员角色和可选的自定义权限（通常权限应该在代码中静态创建）。在`Authorization`容器中已经提供了
大部分的内容，您可以在任意容器下的`Data/Seeders/`目录中找到相应的权限创建代码。
2. 创建角色，并给角色附加一些权限。
3. 创建用户,将其分配给相应的角色。
4. 需要在请求类中通过权限（或者角色）来保护请求。

示例：使用`delete-users` 权限来保护删除用户请求
```php
<?php

namespace App\Containers\User\UI\API\Requests;

use Porto\Core\Requests\Request;

class DeleteUserRequest extends Request
{
   protected $access=[
       'permissions'=>'delete-users',
       'roles'=>'',
   ];

    public function authorize() {
        return $this->check([
            'hasAccess|isOwner',
        ]);
    }
}

```

### 响应体
授权失败的JSON 响应体格式
```json
{
  "errors": "You have no access to this resource!",
  "status_code": 403,
  "message": "This action is unauthorized."
}
```

## 为测试用户分配角色和权限
需要在测试类中设置`$access` 属性，请查看[Test](../other/test.md) 了解更多详细信息

## 管理员信息
超级管理员的账号信息
* email: admin@admin.com
* password: admin
管理员账号信息的数据填充文件在`app/Containers/Authorization/Data/Seeders/AuthorizationDefaultUsersSeeder_3.php`。

