<?php

namespace tests\unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeederTest extends TestCase
{
    public function testTools()
    {
        $this->assertDatabaseHas('tools', ['name' => 'Heroku']);
    }

    public function testUsers()
    {
        $this->assertDatabaseHas('users', ['name' => 'TestUser']);
    }
}
