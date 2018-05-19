<?php
namespace Tests\unit\Controllers;

use App\Http\Controllers\SettingController;
use Tests\TestCase;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\User;

class SettingControllerTest extends TestCase
{

    public function testUpdateConceptMail()
    {
        $auth = new AuthController();
        $controller = new SettingController();
        $user = factory(User::class)->states('admin')->make();
        $auth->login($user);

        $request = Request::create(
            'settings',
            'PUT',
            [
                'settings' => [
                    'conceptmailfrequence' => 'Weekly',
                    'conceptmailday' => 'Tuesday',
                    'conceptmailtime' => '20:30:00',
                ]
            ]
        );
        $controller->updateSettings($request);

        $this->assertDatabaseHas('settings', [
            'name' => 'conceptmailfrequence',
            'val' => 'Weekly',
            'name' => 'conceptmailday',
            'val' => 'Tuesday',
            'name' => 'conceptmailtime',
            'val' => '20:30:00',
        ]);
    }
}
