<?php

$factory->define(App\ToolView::class, function () {
    return [
        'tool_slug' => 'slack',
        'created_at' => now()
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
