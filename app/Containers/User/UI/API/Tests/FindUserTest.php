<?php


namespace App\Containers\User\UI\API\Tests;


use App\Containers\User\Models\User;
use App\Containers\User\Tests\ApiTestCase;

class FindUserTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/users/{id}';

    protected $access = [
        'permissions' => '',
        'roles'       => 'admin'
    ];

    /**
     * 基本测试
     */
    public function testFindUser() {
        $user = $this->getTestingUser();

        $response = $this->injectId($user->id)->makeCall();

        $response->assertStatus(200);

        // 判断查找的用户名是否相同
        $response->assertJsonFragment([
            'name' => $user->name
        ]);
    }

    /**
     * 测试传递include关联的查询
     */
    public function testFindUserWithRelation() {
        $user = factory(User::class, 1)->create()->each(function ($user) {
            $user->assignRole('admin');
        })->first();

        $response = $this->injectId($user->id)->endpoint($this->endpoint . "?include=roles")->makeCall();

        $response->assertStatus(200);

        // 判断查找的用户名是否相同
        $response->assertJsonFragment([
            'name' => $user->name
        ]);

//        dd($this->getResponseContent());
        //判断角色不为null
        $this->assertNotNull($this->getResponseContentObject()->data->roles);
    }
}