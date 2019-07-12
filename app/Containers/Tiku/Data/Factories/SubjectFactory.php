<?php

$factory->define(\App\Containers\Tiku\Models\Subject::class, function (\Faker\Generator $faker) {

    return [
        'name' => $faker->name,
    ];
});