<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\JudgingController;
use App\User;
use App\Tool;
use App\ToolStatus;
use Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JudgingControllerTest extends TestCase
{
    /**
     * Test approveTool()
     *
     * @return void
     */
    public function testApproveTool()
    {
        $auth = new AuthController();
        $toolController = new ToolController();
        $judgingController = new JudgingController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('student')->make();
        $auth->login($user);

        $toolname = 'testName';
        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $toolname,
                'description'   => 'test description',
                'category'      => 'Website',
                'status'        => 'concept',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
        );
        $toolController->store($request);
        
        $tool = Tool::where('slug', Str::slug($toolname))->first();
        $this->assertTrue($tool->status()->first()->isConcept());


        $judgingController->approveTool(Str::slug($toolname));

        $tool = Tool::where('slug', Str::slug($toolname))->first();
        $this->assertTrue($tool->status()->first()->isActive());

    }

    /**
     * Test test rejectTool()
     *
     * @return void
     */
    public function testRejectTool()
    {
        $auth = new AuthController();
        $toolController = new ToolController();
        $judgingController = new JudgingController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('student')->make();
        $auth->login($user);

        $toolname = 'testName';
        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $toolname,
                'description'   => 'test description',
                'category'      => 'Website',
                'status'        => 'concept',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
        );
        $toolController->store($request);
        
        $tool = Tool::where('slug', Str::slug($toolname))->first();
        $this->assertTrue($tool->status()->first()->isConcept());


        $judgingController->rejectTool(Str::slug($toolname));

        $tool = Tool::where('slug', Str::slug($toolname))->first();
        $this->assertTrue($tool->status()->first()->isRejected());

    }

    /**
     * Test requestChanges()
     *
     * @return void
     */
    public function testRequestToolChanges()
    {
        $auth = new AuthController();
        $toolController = new ToolController();
        $judgingController = new JudgingController();
        Storage::fake('tool-images');

        $user = factory(User::class)->states('student')->make();
        $auth->login($user);

        $toolname = 'testName';
        $feedback = 'test feedback';
        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $toolname,
                'description'   => 'test description',
                'category'      => 'Website',
                'status'        => 'concept',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
        );
        
        $toolController->store($request);
        
        $request = Request::create(
            'tools.requestToolChanges',
            'POST',
            [
                'tool_slug'     => Str::slug($toolname),
                'feedback'      => $feedback,    
            ]
        );

        $judgingController->requestToolChanges($request,Str::slug($toolname));

        $tool = Tool::where('slug', Str::slug($toolname))->first();
        $this->assertTrue($tool->feedback()->first()->feedback == $feedback);

    }
}