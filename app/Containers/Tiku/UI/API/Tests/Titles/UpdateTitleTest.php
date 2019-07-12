<?php


namespace App\Containers\Tiku\UI\API\Tests\Titles;


use App\Containers\Tiku\Tests\ApiTestCase;

class UpdateTitleTest extends ApiTestCase
{
    protected $endpoint = 'patch@api/v1/titles/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    /**
     * 修改试题基本信息
     */
    public function testUpdateBaseTitle() {
        $title = $this->createTitle();

        $data = [
            'content'  => $this->faker->text(10),
            'analysis' => $this->faker->text(10),
        ];

        $response = $this->injectId($title->id)->makeCall($data);

        $response->assertStatus(200);

        $response->assertJsonFragment($data);

        $this->assertDatabaseHas('titles', [
            'id'       => $title->id,
            'content'  => $data['content'],
            'analysis' => $data['analysis']
        ]);

    }

    /**
     * 更新属性
     */
    public function testUpdateTitleAttr() {
        $title = $this->createTitle();

        $data = [
            'subject_id' => 12,
            'grade_id'   => 2,
            'type_id'    => 1
        ];

        $response = $this->injectId($title->id)
            ->endpoint($this->endpoint . "?include=attr")
            ->makeCall($data);

        $response->assertStatus(200);
        $response->assertJsonFragment($data + ['title_id' => $title->id]);

        $this->assertDatabaseHas('title_attrs', $data + ['title_id' => $title->id]);
    }

    /**
     * 更新试题选项
     */
    public function testUpdateTitleOptions() {
        $title = $this->createTitle();
        $data = [
            'options' => [
                [
                    'id'      => $title->options->first()->id,
                    'content' => $this->faker->text(10)
                ]
            ]
        ];
        $response = $this->injectId($title->id)->makeCall($data);

        $response->assertStatus(200);

        $response->assertJsonFragment($data['options'][0]);
    }

    /**
     * 更新试题知识点
     */
    public function testUpdateTitleKnowledge() {
        $title = $this->createTitle();
        $knowledge = [4, 5];
        $data = [
            'knowledge' => $knowledge
        ];

        $response = $this->injectId($title->id)->makeCall($data);

        $response->assertStatus(200);

        foreach ($knowledge as $id) {
            $this->assertDatabaseHas('title_knowledges', [
                'knowledge_id' => $id,
                'title_id'     => $title->id
            ]);
        }
    }

    /**
     * 更新空数据
     */
    public function testUpdateTitleEmptyData() {
        $title = $this->createTitle();
        $response = $this->injectId($title->id)->makeCall();

        $response->assertStatus(417);
    }
}