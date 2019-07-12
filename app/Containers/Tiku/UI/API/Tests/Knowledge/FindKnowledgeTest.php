<?php


namespace App\Containers\Tiku\UI\API\Tests\Knowledge;


use App\Containers\Tiku\Models\Knowledge;
use App\Containers\Tiku\Tests\ApiTestCase;

class FindKnowledgeTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/knowledge/{id}';

    /**
     * 查询已存在的数据
     */
    public function testFindExistingKnowledge() {
        $knowledge = factory(Knowledge::class)->create()->first();

        $response = $this->injectId($knowledge->id)->makeCall();

        $response->assertStatus(200);

        $response->assertJsonFragment($knowledge->only(['id', 'name']));
    }

    /**
     * 查询数据-关联查询
     */
    public function testFindKnowledgeWithRelation() {
        $knowledge = factory(Knowledge::class)->create()->first();
        factory(Knowledge::class, 4)->create([
            'pid'        => $knowledge->id,
            'subject_id' => $knowledge->subject_id
        ]);

        $response = $this->injectId($knowledge->id)->endpoint($this->endpoint . '?include=children,subject')->makeCall();

        $response->assertStatus(200);

        $response->assertJsonFragment($knowledge->only(['id', 'name']));
    }


    /**
     * 查询不存在的数据
     */
    public function testFindNonExistingKnowledge() {
        $fakerKnowledgeId = 10000;

        $response = $this->injectId($fakerKnowledgeId)->makeCall();

        $response->assertStatus(422);
    }
}