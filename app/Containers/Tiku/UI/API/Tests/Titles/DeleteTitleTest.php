<?php


namespace App\Containers\Tiku\UI\API\Tests\Titles;


use App\Containers\Tiku\Models\Title;
use App\Containers\Tiku\Models\TitleOption;
use App\Containers\Tiku\Tests\ApiTestCase;

class DeleteTitleTest extends ApiTestCase
{
    protected $endpoint = 'delete@api/v1/titles/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testDeleteTitle() {
        $titleOptions = factory(TitleOption::class, 4)->make();
        $title = factory(Title::class)->create([
            'answers' => $titleOptions->where('is_right', true)->keys()->all()
        ]);
        $title->attr()->create([
            'subject_id' => 11,
            'grade_id'   => 1,
            'type_id'    => 1
        ]);
        $title->options()->createMany($titleOptions->toArray());

        $title->knowledge()->attach([1, 2]);

        $response = $this->injectId($title->id)->makeCall();

        $response->assertStatus(204);

        $this->assertSoftDeleted('titles', ['id' => $title->id]);
    }

    /**
     * 删除不存在的数据
     */
    public function testDeleteNonExistingTitle() {
        $fakerTitleId = 10000;
        $response = $this->injectId($fakerTitleId)->makeCall();

        $response->assertStatus(422);
    }
}