<?php


namespace App\Containers\Tiku\UI\API\Tests\Grades;


use App\Containers\Tiku\Models\Grade;
use App\Containers\Tiku\Tests\ApiTestCase;

class GetAllGradeTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/grades';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testGetAllGrade() {
        // 生成4条数据
        factory(Grade::class, 4)->create();
        $response = $this->makeCall();

        $response->assertStatus(200);

        // 6条初始化数据
        $response->assertJsonCount(6 + 4, 'data');

    }

    public function testSearchGradesByName() {
        $response = $this->endpoint($this->endpoint . '?search=name:初')->makeCall();

        $response->assertStatus(200);

        // 初始化数据时有3条数据包含“初”
        $response->assertJsonCount(3, 'data');
    }
}