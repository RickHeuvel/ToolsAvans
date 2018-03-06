<?php

namespace tests\unit\Feature;

use Tests\TestCase;
use Auth;
use App\User;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function testGuest() {
        $this->assertGuest($guard = null);
    }

    public function testEmployeeLogin()
    {
        $auth = new AuthController;
        $teacher = factory(User::class)->states('employee')->create();
        $auth->login($teacher);

        $this->assertAuthenticated($guard = null);
    }

    public function testStudentLogin()
    {
        $auth = new AuthController;
        $student = factory(User::class)->states('student')->create();
        $auth->login($student);

        $this->assertAuthenticated($guard = null);
    }

    public function testLogout() {
        $auth = new AuthController;
        $student = factory(User::class)->states('student')->create();
        $auth->login($student);

        $this->assertAuthenticated($guard = null);

        $auth->logout();

        $this->assertGuest($guard = null);
    }

}
