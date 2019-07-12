<?php

$factory->define(\App\Containers\Tiku\Models\Grade::class, function (\Faker\Generator $faker) {

    return [
        'name' => $faker->name,
    ];
});