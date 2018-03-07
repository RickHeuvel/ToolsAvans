<?php

namespace tests\unit\Feature;

use Tests\TestCase;
use Auth;
use App\User;
use App\Http\Controllers\AuthController;

class AuthenticationTest extends TestCase
{
    public function testGuest() {
        $this->assertGuest($guard = null);
    }

    public function testEmployeeLogin()
    {
        $auth = new AuthController;
        $teacher = factory(User::class)->states('employee')->make();
        $auth->login($teacher);

        $this->assertAuthenticated($guard = null);
        $this->assertDatabaseHas('users', [
            'name' => $teacher->name,
        ]);
    }

    public function testStudentLogin()
    {
        $auth = new AuthController;
        $student = factory(User::class)->states('student')->make();
        $auth->login($student);

        $this->assertAuthenticated($guard = null);
        $this->assertDatabaseHas('users', [
            'name' => $student->name,
        ]);
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
