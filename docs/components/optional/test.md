# 测试

## 定义
创建测试类以测试Application类是否按预期工作。

此架构的两个最基本的测试类型是单元测试和功能测试。但是，也可以使用集成和验收测试。

## 规则
* 所有类型的测试都可以涵盖容器。
* 使用功能测试来测试容器 `Routes`正在做他们期望的事情。
* 使用单元测试来测试容器`Action`和`Task`正在执行他们期望的操作。
* 所有容器测试类应该从容器内TestCase类 继承`{container-name}/Tests/TestCase.php`。容器TestCase必须 继承 `Porto\Core\Tests\PhpUnit\CoreTestCase`。（向容器添加函数TestCase允许在Container的所有Test类之间共享这些函数）。

## 文件夹结构
```text
- app
    - Containers
        - {container-name}
            - Tests
                - TestCase.php
                - Unit
                    - CreateUserTest.php
                    - UpdateUserTest.php
                    - ...
            - UI
                - API
                    - Tests
                        - LoginTest.php
                        - LogoutTest.php
                        - ...
```

## 代码示例
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