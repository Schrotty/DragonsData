<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/users', 'UserController@index');
Route::get('/user/{id}', 'UserController@single', ['user' => '{id}']);
Route::get('/user/{id}/delete', 'UserController@delete', ['user' => '{id}']);

Route::get('/realms', 'RealmController@index');
Route::get('/realm/{id}', 'RealmController@single', ['realm' => '{id}']);
Route::get('/realm/{realm}/enter/', 'RealmController@assignUser', ['realm' => '{realm}']);

