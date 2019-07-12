<?php

$factory->define(\App\Containers\Tiku\Models\Title::class, function (\Faker\Generator $faker) {
    return [
        'content'  => $faker->text(200),
        'analysis' => $faker->text(200),
        'answers'  => [$faker->randomElement([0, 1, 2, 3])]
    ];
});