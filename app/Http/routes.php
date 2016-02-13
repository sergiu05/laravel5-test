<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
# page routes
Route::get('/', 'PagesController@index');

# test routes
Route::get('test', 'TestController@index');

# authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

# registration routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

# widget routes
Route::get('widget/create', ['as' => 'widget.create', 'uses' => 'WidgetController@create']);
Route::get('widget/{id}-{slug?}', ['as' => 'widget.show', 'uses' => 'WidgetController@show']);
Route::resource('widget', 'WidgetController', ['except' => ['show', 'create']]);

# API routes
Route::any('api/widget', 'ApiController@widgetData');

# admin routes
Route::get('admin', ['as' => 'admin', 'uses'  => 'AdminController@index']);

# terms routes
Route::get('terms-of-service', 'PagesController@terms');
Route::get('privacy', 'PagesController@privacy');


