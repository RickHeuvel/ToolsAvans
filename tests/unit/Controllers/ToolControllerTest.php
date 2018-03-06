<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Http\Controllers\ToolController;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;

class ToolControllerTest extends TestCase
{
    /**
     * Test store()
     *
     * @return void
     */
    public function testStore()
    {
        $user = factory(User::class)->states('employee')->make();
        $this->be($user);
        $this->assertAuthenticated($guard = null);

        $request = Request::create('tools', 'POST', array(
            'name' => 'testName',
            'description' => 'test description',
            'category' => 'webservice',
            'status' => 'active',
            'url' => 'https://www.kaas.nl',
            'thumbnail' => 'kaas.png',
            'uploader_id' => 1,
            'thumbnail' => Image::make('https://i.ytimg.com/vi/yaqe1qesQ8c/maxresdefault.jpg'),
        ));
        $controller = new ToolController();
        $controller->store($request);

        $this->assertDatabaseHas('tools', [
            'name' => 'testName',
        ]);
    }
}
