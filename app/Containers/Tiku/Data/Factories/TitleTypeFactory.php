<?php

$factory->define(\App\Containers\Tiku\Models\TitleType::class, function (\Faker\Generator $faker) {
    static $subjectIds;
    $subjectIds = $subjectIds ?: \App\Containers\Tiku\Models\Subject::all(['id'])->pluck('id')->all();
    return [
        'name'           => $faker->name,
        'subject_id'     => $faker->randomElement($subjectIds),
        'support_online' => $faker->randomElement([true, false])
    ];
});