<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

<<<<<<< HEAD
class ToolControllerTest
{
    /**
     * Test authentication on create()
     *
     * @return void
     */
    public function CreateAuthentication()
    {
    }

    /**
     * Test store()
     *
     * @return void
     */
    public function StoreTool()
    {
        $user = factory(App\User::class)->states('teacher')->make();
        $this->be($user);
        $this->assertAuthenticated($guard = null);
    }

}
