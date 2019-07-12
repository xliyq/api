<?php


namespace App\Containers\Tiku\Data\Seeders;


use Illuminate\Support\Facades\DB;
use Porto\Core\Seeders\CoreSeeders;

class TikuSubjectDefaultSeeder_2 extends CoreSeeders
{
    public function run() {

        $subjects = [
            [
                'id'   => 11,
                'name' => '初中语文',
            ],
            [
                'id'   => 12,
                'name' => '初中数学',
            ],
            [
                'id'   => 13,
                'name' => '初中英语',
            ],
            [
                'id'   => 14,
                'name' => '初中政治',
            ],
            [
                'id'   => 15,
                'name' => '初中历史',
            ],
            [
                'id'   => 16,
                'name' => '初中地理',
            ],
            [
                'id'   => 17,
                'name' => '初中生物',
            ],
            [
                'id'   => 18,
                'name' => '初中物理',
            ],
            [
                'id'   => 19,
                'name' => '初中化学',
            ],
            [
                'id'   => 21,
                'name' => '高中语文',
            ],
            [
                'id'   => 22,
                'name' => '高中数学',
            ],
            [
                'id'   => 23,
                'name' => '高中英语',
            ],
            [
                'id'   => 24,
                'name' => '高中政治',
            ],
            [
                'id'   => 25,
                'name' => '高中历史',
            ],
            [
                'id'   => 26,
                'name' => '高中地理',
            ],
            [
                'id'   => 27,
                'name' => '高中生物',
            ],
            [
                'id'   => 28,
                'name' => '高中物理',
            ],
            [
                'id'   => 29,
                'name' => '高中化学',
            ],
        ];

        DB::table('subjects')->insert($subjects);

    }
}