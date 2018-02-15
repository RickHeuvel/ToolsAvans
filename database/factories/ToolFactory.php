<?php
use Faker\Generator as Faker;

$factory->define(App\Tool::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
?>
