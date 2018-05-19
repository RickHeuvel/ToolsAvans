<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::resources([
    'tools' => 'ToolController',
    'categories' => 'CategoryController',
    'tags' => 'TagController',
    'tagcategories' => 'TagCategoryController'
]);

/* Custom tool routes */
Route::get('tools/image/{filename}', 'ToolController@getImage')->name('tools.image');
Route::post('tools/uploadimage', 'ToolController@uploadImage')->name('tools.uploadImage');
Route::post('tools/removeImage', 'ToolController@removeImage')->name('tools.removeImage');

Route::get('tools/{tool}/approve', 'JudgingController@approveTool')->name('tools.approveTool');
Route::get('tools/{tool}/reject', 'JudgingController@rejectTool')->name('tools.rejectTool');
Route::post('tools/{tool}/requestchanges', 'JudgingController@requestToolChanges')->name('tools.requestToolChanges');
Route::get('tools/{tool}/activate', 'ToolController@activate')->name('tools.activate');
Route::get('tools/{tool}/deactivate', 'ToolController@deactivate')->name('tools.deactivate');

Route::get('tools/{tool}/createrating', 'ReviewController@createRating')->name('tools.createrating');
Route::post('tools/{tool}/addreview', 'ReviewController@addReview')->name('tools.addreview');

Route::get('tools/{tool}/questions', 'QuestionController@show')->name('tools.questions');

Route::post('tools/{tool}/reportoutdated', 'ToolController@reportOutdated')->name('tools.reportOutdated');

/* Question/answer routes */
Route::get('questions/{question}/upvote', 'QuestionController@upvote')->name('questions.upvote');
Route::get('answers/{answer}/upvote', 'AnswerController@upvote')->name('answers.upvote');

Route::post('tools/{tool}/addquestion', 'QuestionController@store')->name('questions.store');
Route::post('tools/{tool}/{question}', 'AnswerController@store')->name('answer.store');

/* Authentication routes */
Route::get('login', 'AuthController@redirectToProvider')->name('login');
Route::get('login-callback', 'AuthController@handleProviderCallback')->name('register');
Route::post('logout', 'AuthController@logout')->name('logout');

/* Portal routes */
Route::get('portal', 'PortalController@index')->name('portal');
Route::get('portal/sendmail', 'JudgingController@sendmail')->name('sendmail');
Route::put('users/updateadmins', 'UserController@updateAdmins')->name('users.updateadmins');
Route::post('settings', 'SettingController@store')->name('settings.store');
Route::put('settings/updatesettings', 'SettingController@updateSettings')->name('settings.updatesettings');