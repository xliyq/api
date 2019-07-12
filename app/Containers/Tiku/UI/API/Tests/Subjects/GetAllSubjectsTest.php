<?php


namespace App\Containers\Tiku\UI\API\Tests\Subjects;


use App\Containers\Tiku\Models\Grade;
use App\Containers\Tiku\Models\Subject;
use App\Containers\Tiku\Tests\ApiTestCase;

class GetAllSubjectsTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/subjects';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testGetAllSubjects() {
        // 生成4条数据
        factory(Subject::class, 4)->create();
        $response = $this->makeCall();

        $response->assertStatus(200);

        // 18条初始化数据
        $size = 18 + 4;
        $response->assertJsonCount($size > 15 ? 15 : $size, 'data');

    }

    public function testSearchSubjectsByName() {
        $response = $this->endpoint($this->endpoint . '?search=name:初中')->makeCall();

        $response->assertStatus(200);

        // 初始化数据时有3条数据包含“初中”
        $response->assertJsonCount(9, 'data');
    }
}