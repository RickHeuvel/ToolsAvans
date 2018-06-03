<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\TagController;
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
    public function testSearch() {
        $controller = new ToolController();
        $discordToolName = 'discord';
        $slackToolName = 'slack';

        $discordTool = Tool::find($discordToolName);
        $slackTool = Tool::find($slackToolName);

        $request = Request::create(
            'tools',// URI
            'GET', // Method
            [
                'searchQuery'   => $discordToolName,
            ]
        );
        $view = $controller->index($request);
        $data = $view->getData();
        $this->assertTrue($data['tools']->contains($discordTool));
        $this->assertFalse($data['tools']->contains($slackTool));
    }

    public function testSearchWithCategory() {
        $controller = new ToolController();
        $discordToolName = 'discord';
        $slackToolName = 'slack';

        $discordTool = Tool::find($discordToolName);
        $slackTool = Tool::find($slackToolName);

        $request = Request::create(
            'tools',// URI
            'GET', // Method
            [
                'searchQuery'   => $discordToolName,
                'categories'    => 'download',
            ]
        );
        $view = $controller->index($request);
        $data = $view->getData();
        $this->assertTrue($data['tools']->contains($discordTool));
        $this->assertFalse($data['tools']->contains($slackTool));
    }

    public function testReportOutdated() {
        $controller = new ToolController();
        $authController = new AuthController();
        $toolSlug = 'slack';
        $feedback = 'Het gebruikt electron, dus het is outdated';
        $tool = Tool::where('slug', $toolSlug)->firstOrFail();

        $user = factory(User::class)->states('student')->make();
        $authController->login($user);

        $request = Request::create(
            'tools.reportOutdated',
            'GET',
            [
                'feedback' => $feedback,
            ]
        );
        $controller->reportOutdated($request, $toolSlug);
        $this->assertDatabaseHas('tools', [
            'slug'        => $toolSlug,
            'status_slug' => 'verouderd'
        ]);
        $this->assertDatabaseHas('tool_outdated_reports', [
            'tool_slug'   => $toolSlug,
            'feedback'    => $feedback
        ]);
    }

    public function testOutdatedToolUpdate() {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $oldName  = 'testName';
        $newName  = 'newTestName';
        $feedback = 'Deze tool werkt alleen op windows 93';

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $oldName,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
                'owner'         => 1,
            ],
            [],     // Cookies
            []      // POST files
        );
        $controller->store($request);

        $request = Request::create(
            'tools.reportOutdated',
            'GET',
            [
                'feedback' => $feedback,
            ]
        );
        $controller->reportOutdated($request, $oldName);
        $this->assertDatabaseHas('tools', [
            'slug'        => $oldName,
            'status_slug' => 'verouderd'
        ]);

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $newName,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage() ]),
                'owner'         => 1,
            ],
            [],     // Cookies
            []      // POST files
        );
        $controller->update($request, $oldName);
        $this->assertDatabaseHas('tools', [
            'slug'        => $newName,
            'status_slug' => 'actief'
        ]);

    }

    /**
     * Test admin store()
     *
     * @return void
     */
    public function testAdminStore() {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('admin')->make();
        $auth->login($user);

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => 'testName',
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
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
     * Test employee store()
     *
     * @return void
     */
    public function testEmployeeStore() {
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
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
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
    public function testStudentStore() {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('student')->make();
        $auth->login($user);

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => 'testName',
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
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
    public function testUpdate() {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $oldName = 'testName';
        $newName = 'newTestName';

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $oldName,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
                'owner'         => 1,
            ],
            [],     // Cookies
            []      // POST files
        );
        $controller->store($request);

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $newName,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage() ]),
                'owner'         => 1,
            ],
            [],     // Cookies
            []      // POST files
        );
        $controller->update($request, $oldName);

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
     * Test tag store()
     *
     * @return void
     */
    public function testTagsStore() {
        $auth = new AuthController();
        $controller = new ToolController();
        $tagController = new TagController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $request = Request::create(
            'tags',
            'POST',
            [
                'name'          => 'testName',
                'default'       => true,
            ]
        );
        $tagController->store($request);

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => 'testName',
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
                'tags' => [
                    'testname',
                ]
            ],
            [],     // Cookies
            []      // POST files
        );

        $controller->store($request);
        $this->assertDatabaseHas('tool_tags', [
            'tool_slug' => Str::slug('testName'),
        ]);
    }

    /**
     * Test tag update())
     *
     * @return void
     */
    public function testTagUpdate() {
        $auth = new AuthController();
        $controller = new ToolController();
        $tagController = new TagController();

        Storage::fake('tool-images');

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $name = 'newTestName';

        $request = Request::create(
            'tags',
            'POST',
            [
                'name'          => $name,
                'default'       => true,
            ]
        );
        $tagController->store($request);

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $name,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
                'owner'         => 1,
                ],
            [],     // Cookies
            []      // POST files
        );
        $controller->store($request);

        $this->assertDatabaseMissing('tool_tags', [
            'tool_slug' => Str::slug($name),
        ]);

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $name,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
                'tags' => [
                    Str::slug($name),
                ],
                'owner'         => 1,
            ],
            [],     // Cookies
            []      // POST files
        );
        $controller->update($request, Str::slug($name));

        $this->assertDatabaseHas('tool_tags', [
            'tool_slug' => Str::slug($name),
        ]);
    }

    /**
     * Test deactivate tool
     *
     * @return void
     */
    public function testDeactivateTool() {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('admin')->make();
        $auth->login($user);

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => 'testName',
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
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
    public function testActivateTool() {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('admin')->make();
        $auth->login($user);

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => 'testName',
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
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
    public function testViewCounterTool() {
        $auth = new AuthController();
        $controller = new ToolController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('student')->make();
        $auth->login($user);

        $toolname = 'testName';
        $toolslug = Str::slug('testName');
        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => 'testName',
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
        );
        $controller->store($request);
        $this->assertTrue(ToolView::where('tool_slug', $toolslug)->count() == 0);
        //Showing the tool twice so we know that the view counter is not adding up per refresh of the webpage which would invalidate the viewcounter.
        $controller->show($toolslug);
        $controller->show($toolslug);
        $this->assertTrue(ToolView::where('tool_slug', $toolslug)->count() == 1);
    }
}
