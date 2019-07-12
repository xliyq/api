<?php


namespace App\Containers\Authorization\UI\API\Tests\Roles;


use App\Containers\Authorization\Models\Role;
use App\Containers\Tiku\Tests\ApiTestCase;

class FindRoleTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/roles/{id}';

    /**
     * 查询已存在的数据
     */
    public function testFindExistingRole() {
        $role = factory(Role::class)->create()->first();

        $response = $this->injectId($role->id)->makeCall();

        $response->assertStatus(200);

        $response->assertJsonFragment($role->only(['id', 'name']));
    }

    /**
     * 查询不存在的数据
     */
    public function testFindNonExistingRole() {
        $fakerRoleId = 10000;

        $response = $this->injectId($fakerRoleId)->makeCall();

        $response->assertStatus(422);
    }
}