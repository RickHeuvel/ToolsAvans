<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToolSeederTest extends TestCase
{
    public function testToolSeeder()
    {
        $this->assertDatabaseHas('tools', ['name' => 'Heroku']);
    }
}
