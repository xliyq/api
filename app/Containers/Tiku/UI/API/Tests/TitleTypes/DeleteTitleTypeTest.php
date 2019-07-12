<?php


namespace App\Containers\Tiku\UI\API\Tests\TitleTypes;


use App\Containers\Tiku\Models\Subject;
use App\Containers\Tiku\Models\TitleType;
use App\Containers\Tiku\Tests\ApiTestCase;

class DeleteTitleTypeTest extends ApiTestCase
{
    protected $endpoint = 'delete@api/v1/title_types/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 删除已有数据
     */
    public function testDeleteExistingTitleType() {
        $titleType = factory(TitleType::class, 1)->create()->first();

        $response = $this->injectId($titleType->id)->makeCall();

        $response->assertStatus(204);
    }


    /**
     * 删除不存在的数据
     */
    public function testDeleteNonExistingTitleType() {
        $titleTypeId = 1000;

        $response = $this->injectId($titleTypeId)->makeCall();

        $response->assertStatus(422);
    }
}