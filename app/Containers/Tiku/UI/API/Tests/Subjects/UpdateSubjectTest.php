<?php


namespace App\Containers\Tiku\UI\API\Tests\Subjects;


use App\Containers\Tiku\Models\Subject;
use App\Containers\Tiku\Tests\ApiTestCase;

class UpdateSubjectTest extends ApiTestCase
{
    protected $endpoint = 'patch@api/v1/subjects/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 更新存在的数据
     */
    public function testUpdateExistingSubject() {
        $subject = factory(Subject::class, 1)->create()->first();
        $data = [
            'name' => 'new name'
        ];
        $response = $this->injectId($subject->id)->makeCall($data);

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    /**
     * 更新存在的数据-不传数据
     */
    public function testUpdateExistingSubjectWithoutData() {
        $subject = factory(Subject::class, 1)->create()->first();

        $response = $this->injectId($subject->id)->makeCall();

        $response->assertStatus(422);
    }

    /**
     * 更新存在的数据-空数据
     */
    public function testUpdateExistingSubjectWithEmpty() {
        $subject = factory(Subject::class, 1)->create()->first();

        $data = [
            'name' => ''
        ];
        $response = $this->injectId($subject->id)->makeCall($data);

        $response->assertStatus(422);
    }

    /**
     * 更新不存在的数据
     */
    public function testUpdateNonExistingSubject() {
        $fakerSubjectId = 10000;
        $data = [
            'name' => 'new name'
        ];
        $response = $this->injectId($fakerSubjectId)->makeCall($data);

        $response->assertStatus(422);
    }
}