<?php


namespace App\Containers\Tiku\UI\API\Tests\Knowledge;


use App\Containers\Tiku\Models\Knowledge;
use App\Containers\Tiku\Tests\ApiTestCase;

class DeleteKnowledgeTest extends ApiTestCase
{
    protected $endpoint = 'delete@api/v1/knowledge/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 删除已存在的数据
     */
    public function testDeleteExistingKnowledge() {
        $knowledge = factory(Knowledge::class)->create();

        $response = $this->injectId($knowledge->id)->makeCall();

        $response->assertStatus(204);
    }

    /**
     * 删除有子集数据的知识点
     */
    public function testDeleteHasChildKnowledge() {
        $knowledge = factory(Knowledge::class)->create();
        $knowledge->children()->save(factory(Knowledge::class)->make([
            'pid'        => $knowledge->id,
            'subject_id' => $knowledge->subject_id
        ]));

        $response = $this->injectId($knowledge->id)->makeCall();

        $response->assertStatus(417);
    }

    /**
     * 删除不存在的数据
     */
    public function testDeleteNonExistingKnowledge() {
        $fakeKnowledgeId = 10000;

        $response = $this->injectId($fakeKnowledgeId)->makeCall();

        $response->assertStatus(422);
    }
}