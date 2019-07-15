<?php


namespace App\Containers\Tiku\UI\API\Tests\TitleTypes;


use App\Containers\Tiku\Models\Grade;
use App\Containers\Tiku\Models\Subject;
use App\Containers\Tiku\Models\TitleType;
use App\Containers\Tiku\Tests\ApiTestCase;

class GetAllTitleTypesTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/title_types';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testGetAllTitleTypes() {
        $data = [
            'subject_id' => 12
        ];
        // 生成4条数据
        factory(TitleType::class, 4)->create($data);

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $count = TitleType::where($data)->count();

        $response->assertJsonCount($count > 15 ? 15 : $count, 'data');

    }

}