<?php

$factory->define(\App\Containers\Tiku\Models\TitleOption::class, function (\Faker\Generator $faker) {
    return [
        'content'  => $faker->text(100),
        'is_right' => $faker->randomElement([true, false]),
    ];
});