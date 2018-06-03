<?php
use Faker\Generator as Faker;

$factory->define(App\ToolView::class, function (Faker $faker) {
    return [
        'tool_slug' => 'slack',
        'created_at' => $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now', $timezone = null)
    ];
});

$factory->state(App\ToolView::class, 'taiga',[
    'tool_slug' => 'taiga',
]);

$factory->state(App\ToolView::class, 'slack',[
    'tool_slug' => 'slack',
]);

$factory->state(App\ToolView::class, 'github',[
    'tool_slug' => 'github',
]);
?>
