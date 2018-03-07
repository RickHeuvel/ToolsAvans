<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ToolController;
use App\User;
use App\Tool;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Storage;

class ToolControllerTest extends TestCase
{
    /**
     * Test store()
     *
     * @return void
     */
    public function testStore()
    {
        $auth = new AuthController();
        $controller = new ToolController();
        // Not working, when using a fake Storage the file doesn't get written
        //Storage::fake('local');

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $request = Request::create('tools', 'POST', array(
            'name' => 'testName',
            'description' => 'test description',
            'category_id' => 1,
            'status' => 'active',
            'url' => 'https://www.kaas.nl',
            'thumbnail' => UploadedFile::fake()->image('thumbnail.png'),
        ));
        $controller->store($request);

        $this->assertDatabaseHas('tools', [
            'name' => 'testName',
        ]);
        Storage::disk('local')->assertExists(Tool::where('name', 'testName')->first()->thumbnail);
    }
}
