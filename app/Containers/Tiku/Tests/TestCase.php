<?php


namespace App\Containers\Tiku\Tests;

use App\Containers\Tiku\Models\Title;
use App\Containers\Tiku\Models\TitleOption;
use App\Ship\Tests\PhpUnit\ShipTestCase;

class TestCase extends ShipTestCase
{
    /**
     * 创建试题
     *
     * @return mixed
     */
    public function createTitle(): Title {
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
        return $title;
    }

}