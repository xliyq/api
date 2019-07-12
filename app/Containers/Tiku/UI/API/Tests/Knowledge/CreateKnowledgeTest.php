<?php


namespace App\Containers\Tiku\UI\API\Tests\Knowledge;


use App\Containers\Tiku\Models\Subject;
use App\Containers\Tiku\Tests\ApiTestCase;

class CreateKnowledgeTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/knowledge';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testCreateKnowledge() {
        $subjects = Subject::all(['id'])->pluck('id')->all();
        $data = [
            'subject_id' => $this->faker->randomElement($subjects),
            'name'       => $this->faker->name,
            'pid'        => 0,
        ];

        $response = $this->makeCall($data);
        $response->assertStatus(201);
        $response->assertJsonFragment(collect($data)->only(['name'])->all());

        $this->assertDatabaseHas('knowledge', $data);
    }
}