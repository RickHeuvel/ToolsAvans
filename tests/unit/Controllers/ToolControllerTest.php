<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ToolController;
use App\User;
use App\Tool;
use App\ToolImage;
use App\ToolView;
use Auth;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ToolControllerTest extends TestCase
{

    /**
     * Test employee store()
     *
     * @return void
     */
    public function testEmployeeStore()
    {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => 'testName',
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
            ],
            [],     // Cookies
            [       // POST files
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
            'status_slug' => 'actief',
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
     * Test student store()
     *
     * @return void
     */
    public function testStudentStore()
    {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('student')->make();
        $auth->login($user);

        $request = Request::create(
            'tools',
            'POST',
            [
                'name'          => 'testName',
                'description'   => 'test description',
                'category'      => 'Website',
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
            'status_slug' => 'concept',
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

    /**
     * Test specification store()
     *
     * @return void
     */
    public function testSpecificationsStore()
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
                'specifications' => [
                    'interne-tool' => 'ja',
                ]
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
        $this->assertDatabaseHas('tool_specifications', [
            'tool_slug' => Str::slug('testName'),
        ]);
    }

    /**
     * Test specification update())
     *
     * @return void
     */
    public function testSpecificationUpdate()
    {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $name = 'newTestName';

        $request = Request::create(
            'tools',
            'POST',
            [
                'name'          => $name,
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

        $this->assertDatabaseMissing('tool_specifications', [
            'tool_slug' => Str::slug($name),
        ]);

        $request = Request::create(
            'tools/' . 'testname',
            'POST',
            [
                'name'          => $name,
                'description'   => 'coole test description',
                'category'      => 'Webservice',
                'status'        => 'Inactief',
                'url'           => 'https://www.newTestWebsite.nl',
                'specifications' => [
                    'interne-tool' => 'ja',
                ]
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
        $controller->update($request, Str::slug($name));

        $this->assertDatabaseHas('tool_specifications', [
            'tool_slug' => Str::slug($name),
        ]);
    }

    /**
     * Test deactivate tool
     *
     * @return void
     */
    public function testDeactivateTool()
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
        $controller->deactivate(Str::slug('testName'));
        $tool = Tool::where('slug', Str::slug('testName'))->first();
        $this->assertTrue($tool->status->isInactive());
    }

    /**
     * Test activate tool
     *
     * @return void
     */
    public function testActivateTool()
    {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('student')->make();
        $auth->login($user);

        $request = Request::create(
            'tools',
            'POST',
            [
                'name'          => 'testName',
                'description'   => 'test description',
                'category'      => 'Website',
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
        $controller->activate(Str::slug('testName'));
        $tool = Tool::where('slug', Str::slug('testName'))->first();
        $this->assertTrue($tool->status->isActive());
    }

    /**
     * Test view counter tool
     *
     * @return void
     */
    public function testViewCounterTool()
    {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('student')->make();
        $auth->login($user);

        $toolname = 'testName';
        $toolslug = Str::slug('testName');
        $request = Request::create(
            'tools',
            'POST',
            [
                'name'          => $toolname,
                'description'   => 'test description',
                'category'      => 'Website',
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
        $this->assertTrue(ToolView::where('tool_slug', $toolslug)->count() == 0);
        //Showing the tool twice so we know that the view counter is not adding up per refresh of the webpage which would invalidate the viewcounter.
        $controller->show($toolslug);
        $controller->show($toolslug);
        $this->assertTrue(ToolView::where('tool_slug', $toolslug)->count() == 1);
    }
}
