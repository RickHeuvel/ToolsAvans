<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\SpecificationController;
use App\User;
use Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Str;

class SpecificationControllerTest extends TestCase
{
    /**
     * Test store()
     *
     * @return void
     */
    public function testStore()
    {
        $auth = new AuthController();
        $controller = new SpecificationController();
        $user = factory(User::class)->states('admin')->make();
        $auth->login($user);

        $request = Request::create(
            'specifications',
            'POST',
            [
                'name'          => 'testName',
                'default'       => true,
            ]
        );
        $controller->store($request);

        $this->assertDatabaseHas('tool_specification_lookup', [
            'name' => 'testName',
            'default' => true,
        ]);
    }

    /**
     * Test store() validation fail
     *
     * @return void
     */
    public function testStoreValidationFail()
    {
        $auth = new AuthController();
        $controller = new SpecificationController();
        $user = factory(User::class)->states('admin')->make();
        $auth->login($user);

        $request = Request::create(
            'specifications',
            'POST',
            [
            ]
        );
        $controller->store($request);

        $this->assertDatabaseMissing('tool_specification_lookup', [
            'name' => 'testName',
        ]);
    }

    /**
     * Test update()
     *
     * @return void
     */
    public function testUpdate()
    {
        $auth = new AuthController();
        $controller = new SpecificationController();
        $user = factory(User::class)->states('admin')->make();
        $auth->login($user);

        $oldName = 'testName';
        $newName = 'newTestName';

        $request = Request::create(
            'specifications',
            'POST',
            [
                'name'          => $oldName,
            ]
        );
        $controller->store($request);

        $request = Request::create(
            'specifications',
            'POST',
            [
                'name'          => $newName,
            ]
        );
        $controller->update($request, 'testname');

        $this->assertDatabaseMissing('tool_specification_lookup', [
            'name' => $oldName,
        ]);
        $this->assertDatabaseHas('tool_specification_lookup', [
            'name' => $newName,
        ]);
    }

    /**
     * Test update() validation fail
     *
     * @return void
     */
    public function testUpdateValidationFail()
    {
        $auth = new AuthController();
        $controller = new SpecificationController();
        $user = factory(User::class)->states('admin')->make();
        $auth->login($user);

        $oldName = 'testName';
        $newName = 'newTestName';

        $request = Request::create(
            'specifications',
            'POST',
            [
                'name'          => $oldName,
            ]
        );
        $controller->store($request);

        $request = Request::create(
            'specifications',
            'POST',
            [
            ]
        );
        $controller->update($request, 'testname');

        $this->assertDatabaseHas('tool_specification_lookup', [
            'name' => $oldName,
        ]);
        $this->assertDatabaseMissing('tool_specification_lookup', [
            'name' => $newName,
        ]);
    }

    /**
     * Test destroy()
     *
     * @return void
     */
    public function testDestroy()
    {
        $auth = new AuthController();
        $controller = new SpecificationController();
        $user = factory(User::class)->states('admin')->make();
        $auth->login($user);

        $name = 'testname';

        $request = Request::create(
            'specifications',
            'POST',
            [
                'name'          => $name,
            ]
        );
        $controller->store($request);

        $this->assertDatabaseHas('tool_specification_lookup', [
            'name' => $name,
        ]);
            
        $controller->destroy(Str::slug($name));

        $this->assertDatabaseMissing('tool_specification_lookup', [
            'name' => $name,
        ]);
    }
}
