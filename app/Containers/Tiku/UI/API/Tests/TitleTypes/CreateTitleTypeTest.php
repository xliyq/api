<?php


namespace App\Containers\Tiku\UI\API\Tests\TitleTypes;


use App\Containers\Tiku\Models\Subject;
use App\Containers\Tiku\Tests\ApiTestCase;

class CreateTitleTypeTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/title_types';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testCreateTitleType() {
        $subjects = Subject::all(['id'])->pluck('id')->all();
        $data = [
            'name'       => $this->faker->name,
            'subject_id' => $this->faker->randomElement($subjects)
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(201);

        $response->assertJsonFragment(collect($data)->only(['name'])->all());

        $this->assertDatabaseHas('title_types', $data);
    }

}