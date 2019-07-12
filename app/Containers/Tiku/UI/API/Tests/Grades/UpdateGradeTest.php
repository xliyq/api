<?php


namespace App\Containers\Tiku\UI\API\Tests\Grades;


use App\Containers\Tiku\Models\Grade;
use App\Containers\Tiku\Tests\ApiTestCase;

class UpdateGradeTest extends ApiTestCase
{
    protected $endpoint = 'patch@api/v1/grades/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 更新存在的数据
     */
    public function testUpdateExistingGrade() {
        $grade = factory(Grade::class, 1)->create()->first();
        $data = [
            'name' => 'new name'
        ];
        $response = $this->injectId($grade->id)->makeCall($data);

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    /**
     * 更新存在的数据-不传数据
     */
    public function testUpdateExistingGradeWithoutData() {
        $grade = factory(Grade::class, 1)->create()->first();

        $response = $this->injectId($grade->id)->makeCall();

        $response->assertStatus(422);
    }

    /**
     * 更新存在的数据-空数据
     */
    public function testUpdateExistingGradeWithEmpty() {
        $grade = factory(Grade::class, 1)->create()->first();

        $data = [
            'name' => ''
        ];
        $response = $this->injectId($grade->id)->makeCall($data);

        $response->assertStatus(422);
    }

    /**
     * 更新不存在的数据
     */
    public function testUpdateNonExistingGrade() {
        $fakerGradeId = 10000;
        $data = [
            'name' => 'new name'
        ];
        $response = $this->injectId($fakerGradeId)->makeCall($data);

        $response->assertStatus(422);
    }
}