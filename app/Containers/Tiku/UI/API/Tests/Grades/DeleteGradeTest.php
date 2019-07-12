<?php


namespace App\Containers\Tiku\UI\API\Tests\Grades;


use App\Containers\Tiku\Models\Grade;
use App\Containers\Tiku\Tests\ApiTestCase;

class DeleteGradeTest extends ApiTestCase
{
    protected $endpoint = 'delete@api/v1/grades/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 删除已存在的数据
     */
    public function testDeleteExistingGrade() {
        $grade = factory(Grade::class, 1)->create()->first();

        $response = $this->injectId($grade->id)->makeCall();

        $response->assertStatus(204);
    }

    /**
     * 删除不存在的数据
     */
    public function testDeleteNonExistingGrade() {
        $fakeGradeId = 10000;

        $response = $this->injectId($fakeGradeId)->makeCall();

        $response->assertStatus(422);
    }
}