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
    return view('test', ['object' => new \App\Models\Realm()]);
});

Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/{id}', 'UserController@single', ['user' => '{id}']);
Route::get('/user/{id}/delete', 'UserController@delete', ['user' => '{id}']);

Route::get('/realms', 'RealmController@index');
Route::get('/realm/{id}', 'RealmController@single', ['realm' => '{id}'])->name('realm');
Route::get('/realm/{realm}/edit/', 'RealmController@editor', ['realm' => '{realm}']);

Route::get('/continent/{id}', 'ContinentController@single', ['continent' => '{id}'])->name('continent');
Route::get('/continent/{continent}/edit/', 'ContinentController@editor', ['oContinent' => '{continent}']);

Route::get('/landscape/{id}', 'LandscapeController@single', ['landscape' => '{id}'])->name('landscape');
Route::get('/landscape/{id}/edit/', 'LandscapeController@editor', ['oContinent' => '{id}']);

/* FORM ACTIONS */
Route::POST('/realm/{id}/save', 'RealmController@save', ['realm' => '{id}']);
Route::POST('/continent/{id}/save', 'ContinentController@save', ['oContinentID' => '{id}']);
Route::POST('/landscape/{id}/save', 'LandscapeController@save', ['iLandscapeID' => '{id}']);