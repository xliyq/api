<?php


namespace App\Containers\Tiku\UI\API\Tests\Knowledge;


use App\Containers\Tiku\Models\Grade;
use App\Containers\Tiku\Models\Knowledge;
use App\Containers\Tiku\Tests\ApiTestCase;

class GetAllKnowledgeTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/knowledge';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testGetAllKnowledge() {
        $data = [
            'subject_id' => 13
        ];
        $size = Knowledge::where('pid', 0)->count();

        // 生成4条数据
        factory(Knowledge::class, 4)->create($data);

        $response = $this->makeCall($data);

        $response->assertStatus(200);

        $size = $size + 4 > 15 ? 15 : $size + 4;
        $response->assertJsonCount($size, 'data');

    }

    public function testSearchKnowledgeByName() {
        factory(Knowledge::class, 1)->create([
            'name'       => '我有关键字初',
            'subject_id' => 13
        ]);
        $data = [
            'subject_id' => 13
        ];
        $response = $this->endpoint($this->endpoint . '?search=name:初')->makeCall($data);

        $response->assertStatus(200);

        $response->assertJsonCount(1, 'data');
    }
}