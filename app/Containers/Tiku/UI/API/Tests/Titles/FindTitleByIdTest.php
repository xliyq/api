<?php


namespace App\Containers\Tiku\UI\API\Tests\Titles;


use App\Containers\Tiku\Tests\ApiTestCase;

class FindTitleByIdTest extends ApiTestCase
{
    protected $endpoint = 'get@api/v1/titles/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => ''
    ];

    public function testFindExistingTitle() {
        $title = $this->createTitle();

        $response = $this->injectId($title->id)->makeCall();

        $response->assertStatus(200);

        $response->assertJsonFragment($title->only(['content', 'analysis']));
        $response->assertJsonStructure(['content', 'analysis', 'options'], $response->decodeResponseJson('data'));

        $this->assertDatabaseHas('titles', ['id' => $title->id]);
    }


    public function testFindExistingTitleWithRelation() {
        $title = $this->createTitle();

        $response = $this->injectId($title->id)
            ->endpoint($this->endpoint . '?include=knowledge,attr.subject,attr.grade,attr.type')->makeCall();

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'knowledge',
            'attr' => [
                'subject',
                'grade',
                'type'
            ]
        ], $response->decodeResponseJson('data'));
    }


    public function testFindNonExistingTitle() {
        $fakerTitleId = 10000;

        $response = $this->injectId($fakerTitleId)->makeCall();

        $response->assertStatus(422);
    }
}