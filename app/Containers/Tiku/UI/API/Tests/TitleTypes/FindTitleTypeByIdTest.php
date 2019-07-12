<?php


namespace App\Containers\Tiku\UI\API\Tests\TitleTypes;


use App\Containers\Tiku\Models\Subject;
use App\Containers\Tiku\Models\TitleType;
use App\Containers\Tiku\Tests\ApiTestCase;

class FindTitleTypeByIdTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/title_types/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 查找已有数据
     */
    public function testFindExistingTitleTypeById() {
        $titleType = factory(TitleType::class, 1)->create()->first();

        $response = $this->injectId($titleType->id)->makeCall();

        $response->assertStatus(200);
        $response->assertJsonFragment($titleType->only(['id', 'name']));
    }

    /**
     * 查找数据 - 关联
     */
    public function testFindTitleTypeWithRelation() {
        $titleType = factory(TitleType::class, 1)->create()->first();

        $response = $this->injectId($titleType->id)->endpoint($this->endpoint.'?include=subject')->makeCall();

        $response->assertStatus(200);
        $response->assertJsonFragment($titleType->only(['id', 'name']));
    }


    /**
     * 查找不存在的数据
     */
    public function testFindNonExistingSubjectById() {
        $titleTypeId = 1000;

        $response = $this->injectId($titleTypeId)->makeCall();

        $response->assertStatus(422);
    }
}