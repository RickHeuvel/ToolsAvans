<?php

namespace tests\unit\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    public function testTeacherLogin()
    {
        $teacher = factory(App\User::class, 1)->states('docent')->make();
        Auth::login($teacher);

        $this->assertAuthenticated($guard = null);
    }

    public function testStudentLogin()
    {
        $student = factory(App\User::class, 1)->states('student')->make();
        Auth::login($student);

        $this->assertAuthenticated($guard = null);
    }
}
