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

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/test', function () {
    return view('test', ['object' => new \App\Realm()]);
});

Route::get('/users', 'UserController@index');
Route::get('/user/{id}', 'UserController@single', ['user' => '{id}']);
Route::get('/user/{id}/delete', 'UserController@delete', ['user' => '{id}']);

Route::get('/realms', 'RealmController@index');
Route::get('/realm/{id}', 'RealmController@single', ['realm' => '{id}']);
Route::get('/realm/{realm}/edit/', 'RealmController@editor', ['realm' => '{realm}']);

Route::get('/continent/{id}', 'ContinentController@single', ['continent' => '{id}']);

/* FORM ACTIONS */
Route::POST('/realm/{id}/save', 'RealmController@save', ['realm' => '{id}']);