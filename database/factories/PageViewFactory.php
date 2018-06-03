<?php
use Faker\Generator as Faker;

$factory->define(App\PageView::class, function (Faker $faker) {
    return [
        'name' => 'home',
        'created_at' => $faker->dateTimeBetween($startDate = '-5 months', $endDate = 'now', $timezone = null)
    ];
});
