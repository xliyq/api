<?php

$factory->define(\App\Containers\Authorization\Models\Role::class, function (\Faker\Generator $faker) {

    return [
        'name'       => $faker->name,
        'guard_name' => 'web'
    ];
});