<?php
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    return [
        'id' => 1000,
        'name' => $firstName,
        'email' => $faker->email,
        'provider' => 'avans',
        'provider_id' => $firstName,
        'nickname' => $faker->name,
        'firstName' => $firstName,
        'lastName' => $faker->lastName,
        'location' => 'OWB',
        'role' => '',
    ];
});

$factory->state(App\User::class, 'student', [
    'role' => 'student',
]);

$factory->state(App\User::class, 'employee', [
    'role' => 'employee',
]);

$factory->state(App\User::class, 'admin', [
    'role' => 'admin',
]);
