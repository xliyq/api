<?php


namespace App\Containers\Authorization\UI\API\Tests\Permissions;


use App\Containers\Authorization\Models\Permission;
use App\Containers\Tiku\Tests\ApiTestCase;

class FindPermissionTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/permissions/{id}';

    /**
     * 查询已存在的数据
     */
    public function testFindExistingPermission() {
        $permission = factory(Permission::class)->create()->first();

        $response = $this->injectId($permission->id)->makeCall();

        $response->assertStatus(200);

        $response->assertJsonFragment($permission->only(['id', 'name']));
    }

    /**
     * 查询不存在的数据
     */
    public function testFindNonExistingPermission() {
        $fakerPermissionId = 10000;

        $response = $this->injectId($fakerPermissionId)->makeCall();

        $response->assertStatus(422);
    }
}