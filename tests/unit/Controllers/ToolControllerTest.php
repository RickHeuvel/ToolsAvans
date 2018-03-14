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
                'status'        => 'Actief',
                'url'           => 'https://www.testWebsite.nl',
            ],
            [],
            [
                'logo'          => UploadedFile::fake()->image('logo.png'),
                'images'        => [
                    UploadedFile::fake()->image('image-1.png'),
                    UploadedFile::fake()->image('image-2.png'),
                    UploadedFile::fake()->image('image-3.png')
                ],
            ]
        );
        $controller->store($request);

        $this->assertDatabaseHas('tools', [
            'name' => 'testName',
        ]);
        Storage::disk('tool-images')->assertExists(Tool::where('name', 'testName')->first()->logo_filename);
        $toolImages = ToolImage::where('tool_slug', 'testname')->get();
        $this->assertTrue(count($toolImages) == 3);
        foreach ($toolImages as $toolImage)
        {
            Storage::disk('tool-images')->assertExists($toolImage->image_filename);
        }
    }

    /**
     * Test update()
     *
     * @return void
     */
    public function testUpdate()
    {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $oldName = 'testName';
        $newName = 'newTestName';
        
        $request = Request::create(
            'tools',
            'POST',
            [
                'name'          => $oldName,
                'description'   => 'test description',
                'category'      => 'Website',
                'status'        => 'Actief',
                'url'           => 'https://www.testWebsite.nl',
            ],
            [],
            [
                'logo'          => UploadedFile::fake()->image('logo.png'),
                'images'        => [
                    UploadedFile::fake()->image('image-1.png'),
                    UploadedFile::fake()->image('image-2.png'),
                    UploadedFile::fake()->image('image-3.png')
                ],
            ]
        );
        $controller->store($request);

        $request = Request::create(
            'tools/' . 'testname',
            'POST',
            [
                'name'          => $newName,
                'description'   => 'coole test description',
                'category'      => 'Webservice',
                'status'        => 'Inactief',
                'url'           => 'https://www.newTestWebsite.nl',
            ],
            [],
            [
                'logo'          => UploadedFile::fake()->image('logo.png'),
                'images'        => [
                    UploadedFile::fake()->image('image-1.png'),
                    UploadedFile::fake()->image('image-3.png')
                ],
            ]
        );
        $controller->update($request, 'testname');

        $this->assertDatabaseMissing('tools', [
            'name' => $oldName,
        ]);
        $this->assertDatabaseHas('tools', [
            'name' => $newName,
        ]);
        Storage::disk('tool-images')->assertExists(Tool::where('name', $newName)->first()->logo_filename);
        $toolImages = ToolImage::where('tool_slug', Str::slug($newName))->get();
        $this->assertTrue(count($toolImages) == 2);
        foreach ($toolImages as $toolImage)
        {
            Storage::disk('tool-images')->assertExists($toolImage->image_filename);
        }
        Storage::disk('tool-images')->assertMissing('testname-3.png');
    }
}
