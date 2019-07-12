<?php


namespace App\Containers\Authorization\UI\API\Tests\Roles;


use App\Containers\Tiku\Tests\ApiTestCase;

class CreateRoleTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/roles';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testCreateRole() {
        $data = [
            'name'         => strtolower('role-name'),
            'display_name' => 'display_name'
        ];

        $response = $this->makeCall($data);
        $response->assertStatus(201);
        $response->assertJsonFragment(collect($data)->only(['name'])->all());

        $this->assertDatabaseHas('roles', $data);
    }
}