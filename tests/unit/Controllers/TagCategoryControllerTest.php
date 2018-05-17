<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\TagCategoryController;
use App\User;
use Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Str;

class TagCategoryControllerTest extends TestCase
{

    /**
     * Test store()
     *
     * @return void
     */
    public function testStore()
    {
        $auth = new AuthController();
        $controller = new TagCategoryController();
        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $request = Request::create(
            'categories',
            'POST',
            [
                'name'          => 'testName',
            ]
        );
        $controller->store($request);

        $this->assertDatabaseHas('tag_category', [
            'name' => 'testName',
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
        $controller = new TagCategoryController();
        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $request = Request::create(
            'categories',
            'POST',
            [
            ]
        );
        $controller->store($request);

        $this->assertDatabaseMissing('tag_category', [
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
        $controller = new TagCategoryController();
        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $oldName = 'testName';
        $newName = 'newTestName';

        $request = Request::create(
            'categories',
            'POST',
            [
                'name'          => $oldName,
            ]
        );
        $controller->store($request);

        $request = Request::create(
            'categories',
            'POST',
            [
                'name'          => $newName,
            ]
        );
        $controller->update($request, 'testname');

        $this->assertDatabaseMissing('tag_category', [
            'name' => $oldName,
        ]);
        $this->assertDatabaseHas('tag_category', [
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
        $controller = new TagCategoryController();
        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $oldName = 'testName';
        $newName = 'newTestName';

        $request = Request::create(
            'categories',
            'POST',
            [
                'name'          => $oldName,
            ]
        );
        $controller->store($request);

        $request = Request::create(
            'categories',
            'POST',
            [
            ]
        );
        $controller->update($request, 'testname');

        $this->assertDatabaseHas('tag_category', [
            'name' => $oldName,
        ]);
        $this->assertDatabaseMissing('tag_category', [
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
        $controller = new TagCategoryController();
        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);

        $name = 'testname';

        $request = Request::create(
            'categories',
            'POST',
            [
                'name'          => $name,
            ]
        );
        $controller->store($request);

        $this->assertDatabaseHas('tag_category', [
            'name' => $name,
        ]);

        $controller->destroy(Str::slug($name));

        $this->assertDatabaseMissing('tag_category', [
            'name' => $name,
        ]);
    }
}
