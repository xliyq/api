<?php


namespace App\Containers\Tiku\UI\API\Tests\Grades;


use App\Containers\Tiku\Models\Grade;
use App\Containers\Tiku\Tests\ApiTestCase;

class FindGradeTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/grades/{id}';

    /**
     * 查询已存在的数据
     */
    public function testFindExistingGrade() {
        $grade = factory(Grade::class)->create()->first();

        $response = $this->injectId($grade->id)->makeCall();

        $response->assertStatus(200);

        $response->assertJsonFragment($grade->only(['id', 'name']));
    }

    /**
     * 查询不存在的数据
     */
    public function testFindNonExistingGrade() {
        $fakerGradeId = 10000;

        $response = $this->injectId($fakerGradeId)->makeCall();

        $response->assertStatus(422);
    }
}