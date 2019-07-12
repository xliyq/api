<?php

$factory->define(\App\Containers\Authorization\Models\Permission::class, function (\Faker\Generator $faker) {

    return [
        'name'       => $faker->name,
        'guard_name' => 'web'
    ];
});