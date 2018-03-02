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
Route::get('tools/image/{filename}', 'ToolController@getImage')->name('tool.image');

Route::get('login', ['as' => 'login', 'uses' => 'AuthController@redirectToProvider']);
Route::get('login-callback', ['as' => 'register', 'uses' => 'AuthController@handleProviderCallback']);
Route::post('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);