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
    'tagcategories' => 'TagCategoryController',
    'questions' => 'QuestionController',
    'answers' => 'AnswerController',
    'reviews' => 'ReviewController',
]);

/* Custom tool routes */
Route::get('tools/image/{filename}', 'ToolController@getImage')->name('tools.image');
Route::post('tools/uploadimage', 'ToolController@uploadImage')->name('tools.uploadImage');
Route::post('tools/removeimage', 'ToolController@removeImage')->name('tools.removeImage');

Route::get('tools/{tool}/approve', 'JudgingController@approveTool')->name('tools.approveTool');
Route::get('tools/{tool}/reject', 'JudgingController@rejectTool')->name('tools.rejectTool');
Route::post('tools/{tool}/requestchanges', 'JudgingController@requestToolChanges')->name('tools.requestToolChanges');
Route::get('tools/{tool}/activate', 'ToolController@activate')->name('tools.activate');
Route::get('tools/{tool}/deactivate', 'ToolController@deactivate')->name('tools.deactivate');

Route::get('tools/{tool}/rating/create', 'ReviewController@createRating')->name('tools.createrating');
Route::post('tools/{tool}/review/store', 'ReviewController@storeReview')->name('tools.review.store');
Route::get('tools/{tool}/teacherreview/create', 'ReviewController@createTeacherReview')->name('tools.teacherreview.create');
Route::get('tools/{tool}/teacherreview/edit', 'ReviewController@editTeacherReview')->name('tools.teacherreview.edit');
Route::post('tools/{tool}/teacherreview/store', 'ReviewController@storeTeacherReview')->name('tools.teacherreview.store');

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
Route::get('logout', 'AuthController@logout')->name('logout');

/* Portal routes */
Route::get('portal', 'PortalController@index')->name('portal');
Route::get('portal/sendmail', 'JudgingController@sendmail')->name('sendmail');
Route::post('settings', 'SettingController@store')->name('settings.store');
Route::put('settings/updateconceptmail', 'SettingController@updateConceptMail')->name('settings.updateconceptmail');
Route::put('settings/updatesettings', 'SettingController@updateSettings')->name('settings.updatesettings');

/* Graph routes */
Route::get('statistics/getdata', 'GraphController@getData')->name('graph.getData');
Route::get('statistics/gettools', 'GraphController@getTools')->name('graph.getTools');

/* Contact routes*/
Route::get('contact', 'ContactController@index')->name('contact.index');
Route::post('contact', 'ContactController@sendQuestion')->name('contact.store');

/* User routes */
Route::get('users/completeprofile', 'UserController@completeprofile')->name('users.completeprofile');
Route::post('users/storeprofile', 'UserController@storeprofile')->name('users.storeprofile');
Route::put('users/updateacademy', 'UserController@updateAcademy')->name('users.updateacademy');
Route::put('users/updateadmins', 'UserController@updateAdmins')->name('users.updateadmins');
