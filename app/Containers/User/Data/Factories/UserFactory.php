<?php


$factory->define(\App\Containers\User\Models\User::class, function (\Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'phone'          => $faker->phoneNumber,
        'password'       => $password ?: $password = \Illuminate\Support\Facades\Hash::make('testing-password'),
        'remember_token' => str_random(10),
    ];
});