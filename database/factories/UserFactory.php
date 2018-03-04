<?php
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    return [
        'name' => $firstName,
        'email' => $faker->email,
        'password' => $faker->password,
        'provider' => 'avans',
        'provider_id' => $firstName,
        'nickname' => $faker->name,
        'firstName' => $firstName,
        'lastName' => $faker->lastName,
        'location' => 'OWB',
    ];
});

$factory->state(App\User::class, 'student', [
    'role' => 'student',
]);

$factory->state(App\User::class, 'teacher', [
    'role' => 'docent',
]);
?>
