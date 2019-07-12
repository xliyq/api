<?php


namespace App\Containers\User\UI\API\Tests;

use App\Containers\User\Tests\ApiTestCase;

class RegisterTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/register';

    protected $access = [];

    public function testRegister() {
        $data = [
            'phone'    => '15800000001',
            'name'     => 'user',
            'password' => 'secret',
        ];

        //调用接口
        $response = $this->makeCall($data);

        //判断返回码
        $response->assertStatus(201);

        //判断返回值是否包含给定的手机号和用户名
        $response->assertJsonFragment([
            'phone' => $data['phone'],
            'name'  => $data['name']
        ]);

        // 判断返回值是否包含id
        $this->assertResponseContainKeys(['id']);

        //判断手机号是否入库
        $this->assertDatabaseHas('users', ['phone' => $data['phone']]);
    }
}