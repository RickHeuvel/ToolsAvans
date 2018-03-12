<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ToolController;
use App\User;
use App\Tool;
use App\ToolImage;
use Auth;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        Storage::fake('tool-images');

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $request = Request::create(
            'tools',
            'POST',
            [
                'name'          => 'testName',
                'description'   => 'test description',
                'category'      => 'Website',
                'status'        => 'actief',
                'url'           => 'https://www.testWebsite.nl',
            ],
            [],
            [
                'logo'          => UploadedFile::fake()->image('logo.png'),
                'image-1'       => UploadedFile::fake()->image('image-1.png'),
                'image-2'       => UploadedFile::fake()->image('image-2.png'),
                'image-3'       => UploadedFile::fake()->image('image-3.png'),
            ]
        );
        $controller->store($request);

        $this->assertDatabaseHas('tools', [
            'name' => 'testName',
        ]);
        $this->assertDatabaseHas('tool_images', [
            'tool_slug'         => Str::slug('testName'),
            'image_filename'    => Str::slug('testName') . '-1.png',
        ]);
        $this->assertDatabaseHas('tool_images', [
            'tool_slug'         => Str::slug('testName'),
            'image_filename'    => Str::slug('testName') . '-2.png',
        ]);
        $this->assertDatabaseHas('tool_images', [
            'tool_slug'         => Str::slug('testName'),
            'image_filename'    => Str::slug('testName') . '-3.png',
        ]);
        Storage::disk('local')->assertExists(Tool::where('name', 'testName')->first()->logo_filename);
        $toolImages = ToolImage::where('tool_slug', Str::slug('testName'))->get();
        foreach ($toolImages as $toolImage)
        {
            Storage::disk('local')->assertExists($toolImage->image_filename);
        }
    }
}
