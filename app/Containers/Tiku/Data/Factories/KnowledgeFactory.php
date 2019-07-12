<?php

$factory->define(\App\Containers\Tiku\Models\Knowledge::class, function (\Faker\Generator $faker) {
    static $subjectIds;
    $subjectIds = $subjectIds ?: \App\Containers\Tiku\Models\Subject::all(['id'])->pluck('id')->all();
    return [
        'name'       => $faker->name,
        'subject_id' => $faker->randomElement($subjectIds),
        'pid'        => 0,
        'sort'       => $faker->numberBetween(0, 100)
    ];
});