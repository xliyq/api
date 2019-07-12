<?php


namespace App\Containers\Tiku\UI\API\Tests\Titles;


use App\Containers\Tiku\Tests\ApiTestCase;

class GetAllTitlesTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/titles?include=attr.subject,attr.type,attr.grade,knowledge';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testGetAllTitles() {

        $data = [
            'subject_id'   => 11,
            'type_id'      => 1,
            'grade_id'     => 1,
            'knowledge_id' => 1,
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(200);

        // 为科目11初始化了10条数据
        $response->assertJsonCount(10, 'data');

        $response->assertJsonStructure([
            'id', 'content', 'analysis', 'answers', 'options', 'attr' => ['subject', 'type', 'grade'], 'knowledge'
        ], $response->decodeResponseJson('data')[0]);

    }
}