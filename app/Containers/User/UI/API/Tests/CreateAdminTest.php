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
    public function testCreateAdmin() {
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
//        $response->assertJsonStructure(['id']);

        // 断言数据库是否包含手机号
        $this->assertDatabaseHas('users', ['phone' => $data['phone']]);

        // 断言用户角色
        $user = User::where(['phone' => $data['phone']])->first();
        $this->assertEquals($user->hasRole('admin'), true);
    }
}