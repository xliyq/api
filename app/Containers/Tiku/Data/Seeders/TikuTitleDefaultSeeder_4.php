<?php


namespace App\Containers\Tiku\Data\Seeders;


use App\Containers\Tiku\Models\Title;
use App\Containers\Tiku\Models\TitleOption;
use App\Containers\Tiku\Models\TitleType;
use Illuminate\Support\Facades\DB;
use Porto\Core\Seeders\CoreSeeders;

class TikuTitleDefaultSeeder_4 extends CoreSeeders
{
    public function run() {
        $types = factory(TitleType::class, 5)->make();
        DB::table('title_types')->insert($types->toArray());

        factory(Title::class, 10)->create()->each(function (Title $title) {
            $title->options()->createMany(factory(TitleOption::class, 4)->make()->toArray());
            $title->attr()->create([
                'subject_id' => 11,
                'grade_id'   => 1,
                'type_id'    => 1,
            ]);
            $title->knowledge()->attach(1);
        });


    }
}