<?php


namespace App\Containers\Authorization\UI\API\Tests\Roles;


use App\Containers\Authorization\Models\Role;
use App\Containers\Tiku\Tests\ApiTestCase;

class DeleteRoleTest extends ApiTestCase
{
    protected $endpoint = 'delete@api/v1/roles/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 删除已存在的数据
     */
    public function testDeleteExistingRole() {
        $role = factory(Role::class, 1)->create()->first();

        $response = $this->injectId($role->id)->makeCall();

        $response->assertStatus(204);
    }

    /**
     * 删除不存在的数据
     */
    public function testDeleteNonExistingRole() {
        $fakeRoleId = 10000;

        $response = $this->injectId($fakeRoleId)->makeCall();

        $response->assertStatus(422);
    }
}