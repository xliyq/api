<?php


namespace App\Containers\Tiku\UI\API\Tests\TitleTypes;


use App\Containers\Tiku\Models\TitleType;
use App\Containers\Tiku\Tests\ApiTestCase;

class UpdateTitleTypesTest extends ApiTestCase
{
    protected $endpoint = 'patch@api/v1/title_types/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 更新存在的数据
     */
    public function testUpdateExistingTitleType() {
        $titleType = factory(TitleType::class, 1)->create()->first();
        $data = [
            'name' => 'new name'
        ];
        $response = $this->injectId($titleType->id)->makeCall($data);

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    /**
     * 更新存在的数据-不传数据
     */
    public function testUpdateExistingTitleTypeWithoutData() {
        $titleType = factory(TitleType::class, 1)->create()->first();

        $response = $this->injectId($titleType->id)->makeCall();

        $response->assertStatus(422);
    }

    /**
     * 更新存在的数据-空数据
     */
    public function testUpdateExistingTitleTypeWithEmpty() {
        $titleType = factory(TitleType::class, 1)->create()->first();

        $data = [
            'name' => ''
        ];
        $response = $this->injectId($titleType->id)->makeCall($data);

        $response->assertStatus(422);
    }

    /**
     * 更新不存在的数据
     */
    public function testUpdateNonExistingSubject() {
        $fakerTitleTypeId = 10000;
        $data = [
            'name' => 'new name'
        ];
        $response = $this->injectId($fakerTitleTypeId)->makeCall($data);

        $response->assertStatus(422);
    }
}