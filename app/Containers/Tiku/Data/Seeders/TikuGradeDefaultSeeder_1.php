<?php


namespace App\Containers\Tiku\Data\Seeders;


use Porto\Core\Seeders\CoreSeeders;
use Porto\Core\Support\Facades\Porto;

class TikuGradeDefaultSeeder_1 extends CoreSeeders
{
    public function run() {

        $grades = [
            '初一',
            '初二',
            '初三',
            '高一',
            '高二',
            '高三',
        ];

        foreach ($grades as $grade) {
            Porto::call('Tiku@CreateGradeTask', [$grade]);
        }


    }
}