# 测试助手
除了Laravel的默认测试之外，还提供了额外的助手函数，以使测试API根据便捷。

## 属性

### `$endpoint`
`$endpoint`属性是用于定义调用`$this->makeCall()`是试图访问的请求地址。

示例：
```php
<?php

namespace App\Containers\User\UI\API\Tests;

use App\Containers\User\Models\User;
use App\Containers\User\Tests\ApiTestCase;

/**
 * Class CreateAdminTest
 * 创建管理员的测试
 *
 * @package App\Containers\User\UI\API\Tests
 *
 * author liyq <2847895875@qq.com>
 */
class CreateAdminTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/admins';

    protected $access = [
        'permissions' => 'create-admins',
        'roles'       => ''
    ];

    /**
     * @test
     */
    public function testCreateAdmin_() {
        $data = [
            'phone'    => '12345678901',
            'name'     => 'admin',
            'password' => 'secret',
        ];

        //调用接口
        $response = $this->makeCall($data);

        //断言返回码
        $response->assertStatus(201);

        //断言返回关键内容
        $response->assertJsonFragment([
            'phone' => $data['phone'],
            'name'  => $data['name']
        ]);

        // 断言是否包含id
        $this->assertResponseContainKeys(['id']);

        // 断言数据库是否包含手机号
        $this->assertDatabaseHas('users', ['phone' => $data['phone']]);

        // 断言用户角色
        $user = User::where(['phone' => $data['phone']])->first();
        $this->assertEquals($user->hasRole('admin'), true);
    }
}
```
> 覆盖该属性的方式 `$this->endpoint('get@api/v1/xxx')->makeCall()`

### `$auth`
`$auth`属性用于定义视图访问请求是是否需要身份验证。默认情况下为`true`。

当`$auth`为`true`时，如果没有找到测试用户，`makeCall`将创建一个测试用户，并在调用之前将其访问令牌插入到请求头中。


### `$access`
`$access`属性用于定义需要授予该测试类中的测试用户的权限/角色。当使用`$user=$this->getTestingUser()`时,将自动接受您授予它的所有角色和权限。
```php
<?php
    protected $access=[
        'roles'=>'admin', // 或者['admin','manager']
        'permissions'=>'delete-users'
    ];
```
> 调用`getTestingUser()`时如需重定义权限`$this->getTestingUser(['permissions' => 'jump', 'roles' => 'jumper']);`
> 或者使用`getTestingUserWithoutAccess()` 不设定任何权限。

### ``