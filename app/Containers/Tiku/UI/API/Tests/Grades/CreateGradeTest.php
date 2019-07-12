<?php


namespace App\Containers\Tiku\UI\API\Tests\Grades;


use App\Containers\Tiku\Tests\ApiTestCase;

class CreateGradeTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/grades';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testCreateGrade() {
        $data = [
            'name' => $this->faker->name
        ];

        $response = $this->makeCall($data);
        $response->assertStatus(201);
        $response->assertJsonFragment($data);

        $this->assertDatabaseHas('grades', $data);
    }
}