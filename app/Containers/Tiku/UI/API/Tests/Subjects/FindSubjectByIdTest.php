<?php


namespace App\Containers\Tiku\UI\API\Tests\Subjects;


use App\Containers\Tiku\Models\Subject;
use App\Containers\Tiku\Tests\ApiTestCase;

class FindSubjectByIdTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/subjects/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 查找已有数据
     */
    public function testFindExistingSubjectById() {
        $subject = factory(Subject::class, 1)->create()->first();

        $response = $this->injectId($subject->id)->makeCall();

        $response->assertStatus(200);
        $response->assertJsonFragment($subject->only(['name']));
    }


    /**
     * 查找不存在的数据
     */
    public function testFindNonExistingSubjectById() {
        $subjectId = 1000;

        $response = $this->injectId($subjectId)->makeCall();

        $response->assertStatus(422);
    }
}