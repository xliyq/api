<?php


namespace App\Containers\Tiku\Data\Seeders;


use App\Containers\Tiku\Models\Knowledge;
use Porto\Core\Seeders\CoreSeeders;

class TikuKnowledgeDefaultSeeder_3 extends CoreSeeders
{
    public function run() {
        factory(Knowledge::class, 5)->create()->each(function ($knowledge) {
            factory(Knowledge::class, 2)->create([
                'pid'        => $knowledge->id,
                'subject_id' => $knowledge->subject_id
            ])->each(function ($k) {
                factory(Knowledge::class, 5)->create([
                    'pid'        => $k->id,
                    'subject_id' => $k->subject_id
                ]);
            });
        });
    }
}