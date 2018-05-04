<?php
namespace tests\unit\Controllers;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\User;
use App\ToolReview;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ToolController;
use Auth;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReviewControllerTest extends TestCase
{

    /**
     * Test create Rating()
     *
     * @return void
     */
    public function testCreateRating()
    {
        $auth = new AuthController();
        $toolController = new ToolController();
        $reviewController = new ReviewController();

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);
        
        $toolname = 'testname';
        $toolslug = Str::slug($toolname);
        $reviewrating = 4;      
        //Store a tool to make a review
        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $toolname,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
        );
        $toolController->store($request);
        //Simulate Ajax request
        $server = ['HTTP_X-Requested-With' => 'XMLHttpRequest'];
        $request = Request::create(
            'reviews',
            'POST',
        [
            'tool_slug'     => $toolslug,
            'user_id'       => $user->id,
            'rating'        => $reviewrating,
        ],
        [],[], $server);

        $reviewController->createRating($request, $toolslug);
        $review = ToolReview::where('tool_slug', $toolslug)->first();
        $this->assertTrue($review->rating == $reviewrating);
    }

    /**
     * Test createRatingWithoutAjax()
     * This test is created solely for 100% code coverage
     * @return void
     */
    public function testCreateRatingWithoutAjax()
    {
        $auth = new AuthController();
        $toolController = new ToolController();
        $reviewController = new ReviewController();

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);
        
        $toolname = 'testname';
        $toolslug = Str::slug($toolname);
        $reviewrating = 4;      
        //Store a tool to make a review
        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $toolname,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
        );
        $toolController->store($request);

        $request = Request::create(
            'reviews',
            'POST',
        [
            'tool_slug'     => $toolslug,
            'user_id'       => $user->id,
            'rating'        => $reviewrating,
        ],
        []);

        $reviewController->createRating($request, $toolslug);
        $review = ToolReview::where('tool_slug', $toolslug)->first();
        $this->assertDatabaseMissing('tool_reviews', ['tool_slug' => $toolslug]);
    }

    /**
     * Test update CreateRating()
     *
     * @return void
     */
    public function testUpdateCreateRating()
    {
        $auth = new AuthController();
        $toolController = new ToolController();
        $reviewController = new ReviewController();

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);
        
        $toolname = 'testname';
        $toolslug = Str::slug($toolname);
        $reviewrating = 4; 
        $newreviewrating = 1;     
        //Store a tool to make a review
        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $toolname,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
        );
        $toolController->store($request);

        //Simulate Ajax request
        $server = ['HTTP_X-Requested-With' => 'XMLHttpRequest'];
        
        $request = Request::create(
            'reviews',
            'POST',
        [
            'tool_slug'     => $toolslug,
            'user_id'       => $user->id,
            'rating'        => $reviewrating,
        ],
        [],[], $server);

        $reviewController->createRating($request, $toolslug);
        $review = ToolReview::where('tool_slug', $toolslug)->first();
        $this->assertTrue($review->rating == $reviewrating);

        $request = Request::create(
            'reviews',
            'POST',
        [
            'tool_slug'     => $toolslug,
            'user_id'       => $user->id,
            'rating'        => $newreviewrating,
        ],
        [],[], $server);
        $reviewController->createRating($request, $toolslug);

        $review = ToolReview::where('tool_slug', $toolslug)->first();
        $this->assertTrue($review->rating == $newreviewrating);
    }

    /**
     * Test addReview()
     *
     * @return void
     */
    public function testAddReview()
    {
        $auth = new AuthController();
        $toolController = new ToolController();
        $reviewController = new ReviewController();

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);
        
        $toolname = 'testname';
        $toolslug = Str::slug($toolname);
        $rating = 4;      
        $title = 'test titel';
        $description = 'test description';

        //Store a tool to make a review
        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $toolname,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
        );
        $toolController->store($request);

        //Simulate Ajax request
        $server = ['HTTP_X-Requested-With' => 'XMLHttpRequest'];
        $request = Request::create(
            'reviews',
            'POST',
        [
            'tool_slug'     => $toolslug,
            'user_id'       => $user->id,
            'rating'        => $rating,
        ],
        [],[], $server);
        $reviewController->createRating($request, $toolslug);

        $request = Request::create(
            'reviews',
            'POST',
            [
                'title'         => $title,
                'description'   => $description,
            ]
        );
        $reviewController->addReview($request, $toolslug);

        $review = ToolReview::where('tool_slug', $toolslug)->first();
        $this->assertTrue($review->title == $title);
        $this->assertTrue($review->description == $description);
        $this->assertTrue($review->rating == $rating);
    }

    /**
     * Test validation addReview()
     *
     * @return void
     */
    public function testValidationAddReview()
    {
        $auth = new AuthController();
        $toolController = new ToolController();
        $reviewController = new ReviewController();

        $user = factory(User::class)->states('employee')->make();
        $auth->login($user);
        
        $toolname = 'testname';
        $toolslug = Str::slug($toolname);
        $rating = 4;      
        $title = 'test titel';
        $description = 'test description';

        //Store a tool to make a review
        $request = Request::create(
            'tools',// URI
            'POST', // Method
            [       // POST input
                'name'          => $toolname,
                'description'   => 'test description',
                'category'      => 'Website',
                'url'           => 'https://www.testWebsite.nl',
                'logo'          => $this->uploadImage(),
                'images'        => json_encode([ $this->uploadImage(), $this->uploadImage(), $this->uploadImage() ]),
            ],
            [],     // Cookies
            []      // POST files
        );
        $toolController->store($request);

        $server = ['HTTP_X-Requested-With' => 'XMLHttpRequest'];
        $request = Request::create(
            'reviews',
            'POST',
        [
            'tool_slug'     => $toolslug,
            'user_id'       => $user->id,
            'rating'        => $rating,
        ],
        [],[], $server);
        $reviewController->createRating($request, $toolslug);


        $request = Request::create(
            'reviews',
            'POST',
            [
                //Empty on purpose to check if the validation fails
            ]
        );
        $reviewController->addReview($request, $toolslug);

        $review = ToolReview::where('tool_slug', $toolslug)->first();
        $this->assertTrue($review->title == null);
        $this->assertTrue($review->description == null);
    }
}
