<?php


namespace App\Containers\Tiku\UI\API\Tests\Titles;


use App\Containers\Tiku\Models\Grade;
use App\Containers\Tiku\Models\Knowledge;
use App\Containers\Tiku\Models\Subject;
use App\Containers\Tiku\Models\Title;
use App\Containers\Tiku\Models\TitleOption;
use App\Containers\Tiku\Models\TitleType;
use App\Containers\Tiku\Tests\ApiTestCase;

class CreateTitleTest extends ApiTestCase
{
    protected $endpoint = 'post@api/v1/titles';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testCreateTest() {
        $subjectIds = Subject::all(['id'])->pluck('id')->all();
        $gradeIds = Grade::all(['id'])->pluck('id')->all();
//        $typeIds = TitleType::all(['id'])->pluck('id')->all();
        $typeIds = factory(TitleType::class)->create();
        $knowledgeIds = factory(Knowledge::class, 2)->create()->pluck('id');
        $options = factory(TitleOption::class, 4)->make();
        $title = factory(Title::class)->make([
            'answers' => $options->where('is_right', true)->keys()->all()
        ])->toArray();
        $data = $title + [
                'options'    => $options->toArray(),
                'knowledge'  => $this->faker->randomElements($knowledgeIds, 2),
                'subject_id' => $this->faker->randomElement($subjectIds),
                'type_id'    => $typeIds->id,
                'grade_id'   => $this->faker->randomElement($gradeIds)
            ];

        $response = $this->makeCall($data);

        $response->assertStatus(201);
        $responseData = $response->decodeResponseJson('data');

        $this->assertDatabaseHas('titles', collect($data)->only(['content', 'analysis'])->all());
        $this->assertDatabaseHas('title_knowledges', [
            'title_id' => $responseData['id']
        ]);
        $this->assertDatabaseHas('title_attrs', [
            'title_id' => $responseData['id']
        ]);

        $this->assertDatabaseHas('title_options', [
            'title_id' => $responseData['id']
        ]);

    }
}