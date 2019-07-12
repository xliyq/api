<?php


namespace App\Containers\Tiku\UI\API\Tests\Subjects;


use App\Containers\Tiku\Tests\ApiTestCase;

class CreateSubjectTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/subjects';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testCreateSubject() {
        $data = [
            'name' => $this->faker->name
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(201);

        $response->assertJsonFragment($data);

        $this->assertDatabaseHas('subjects', $data);
    }

}