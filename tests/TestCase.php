<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\ToolController;
use Request;
use Illuminate\Http\UploadedFile;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    public function uploadImage() {
        $controller = new ToolController();

        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [],     // POST input
            [],     // Cookies
            [       // POST files
                'image'          => UploadedFile::fake()->image('test_image.png'),
            ]
        );

        return $controller->uploadImage($request);
    }
}
