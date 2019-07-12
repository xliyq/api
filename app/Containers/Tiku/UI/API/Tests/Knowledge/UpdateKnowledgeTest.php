<?php


namespace App\Containers\Tiku\UI\API\Tests\Knowledge;


use App\Containers\Tiku\Models\Knowledge;
use App\Containers\Tiku\Tests\ApiTestCase;

class UpdateKnowledgeTest extends ApiTestCase
{
    protected $endpoint = 'patch@api/v1/knowledge/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 更新存在的数据
     */
    public function testUpdateExistingKnowledge() {
        $knowledge = factory(Knowledge::class, 1)->create()->first();
        $data = [
            'name' => 'new name',
            'sort' => 100
        ];
        $response = $this->injectId($knowledge->id)->makeCall($data);

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    /**
     * 更新存在的数据-不传数据
     */
    public function testUpdateExistingKnowledgeWithoutData() {
        $knowledge = factory(Knowledge::class, 1)->create()->first();

        $response = $this->injectId($knowledge->id)->makeCall();

        $response->assertStatus(422);
    }

    /**
     * 更新存在的数据-空数据
     */
    public function testUpdateExistingKnowledgeWithEmpty() {
        $knowledge = factory(Knowledge::class, 1)->create()->first();

        $data = [
            'name' => ''
        ];
        $response = $this->injectId($knowledge->id)->makeCall($data);

        $response->assertStatus(422);
    }

    /**
     * 更新不存在的数据
     */
    public function testUpdateNonExistingKnowledge() {
        $fakerKnowledgeId = 10000;
        $data = [
            'name' => 'new name'
        ];
        $response = $this->injectId($fakerKnowledgeId)->makeCall($data);

        $response->assertStatus(422);
    }
}