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
Route::get('portal', 'PortalController@index')->name('portal');

Route::resource('tools', 'ToolController');
Route::get('tools/image/{filename}', 'ToolController@getImage')->name('tools.image');
Route::get('tools/{tool}/approve', 'JudgingController@approveTool')->name('tools.approveTool');
Route::get('tools/{tool}/reject', 'JudgingController@rejectTool')->name('tools.rejectTool');
Route::post('tools/{tool}/requestchanges', 'JudgingController@requestToolChanges')->name('tools.requestToolChanges');
Route::get('tools/{tool}/activate', 'ToolController@activate')->name('tools.activate');
Route::get('tools/{tool}/deactivate', 'ToolController@deactivate')->name('tools.deactivate');

Route::resource('categories', 'CategoryController');
Route::resource('specifications', 'SpecificationController');


Route::get('login', ['as' => 'login', 'uses' => 'AuthController@redirectToProvider']);
Route::get('login-callback', ['as' => 'register', 'uses' => 'AuthController@handleProviderCallback']);
Route::post('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

Route::get('tools/{tool}/createrating', 'ReviewController@createRating')->name('tools.createrating');
Route::post('tools/{tool}/addreview', 'ReviewController@addReview')->name('tools.addreview');