<?php


namespace App\Containers\User\UI\API\Tests;


use App\Containers\User\Tests\ApiTestCase;

class GetAllUserTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/users';


    protected $access = [
        'permissions' => 'list-users',
        'roles'       => 'admin'
    ];

    public function testGetAllUser() {
        $data = [];

        $response = $this->makeCall($data);

        // 断言
        $response->assertStatus(200);

        // 断言结构
        $response->assertJsonStructure([
            'data' => [['id', 'name']]
        ]);

    }
}