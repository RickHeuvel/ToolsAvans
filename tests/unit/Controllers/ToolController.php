<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToolControllerTest extends ControllerTestCase
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
        $user = factory(App\User::class, 1)->states('teacher')->make();
        Auth::login($user)

    }

}
