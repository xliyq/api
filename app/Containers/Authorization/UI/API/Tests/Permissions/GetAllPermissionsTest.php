<?php


namespace App\Containers\Authorization\UI\API\Tests\Permissions;


use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Tests\ApiTestCase;

class GetAllPermissionsTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/permissions';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testGetAllPermissions() {
        $count = Permission::count();
        $size = 10;
        factory(Permission::class, $size)->create();
        $response = $this->makeCall();

        $response->assertStatus(200);
        $count = ($count + $size) > 15 ? 15 : $count + $size;
        $response->assertJsonCount($count, 'data');
    }
}