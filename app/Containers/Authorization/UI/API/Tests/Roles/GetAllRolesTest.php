<?php


namespace App\Containers\Authorization\UI\API\Tests\Roles;


use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\ApiTestCase;

class GetAllRolesTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/roles';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testGetAllRoles() {
        $count = Role::count();
        $size = 10;
        factory(Role::class, $size)->create();
        $response = $this->makeCall();

        $response->assertStatus(200);
        $count = ($count + $size) > 15 ? 15 : $count + $size;
        $response->assertJsonCount($count, 'data');
    }
}