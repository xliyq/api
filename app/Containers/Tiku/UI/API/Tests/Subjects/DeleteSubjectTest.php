<?php


namespace App\Containers\Tiku\UI\API\Tests\Subjects;


use App\Containers\Tiku\Models\Subject;
use App\Containers\Tiku\Tests\ApiTestCase;

class DeleteSubjectTest extends ApiTestCase
{
    protected $endpoint = 'delete@api/v1/subjects/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 删除已有数据
     */
    public function testDeleteExistingSubject() {
        $subject = factory(Subject::class, 1)->create()->first();

        $response = $this->injectId($subject->id)->makeCall();

        $response->assertStatus(204);
    }


    /**
     * 删除不存在的数据
     */
    public function testDeleteNonExistingSubject() {
        $subjectId = 1000;

        $response = $this->injectId($subjectId)->makeCall();

        $response->assertStatus(422);
    }
}