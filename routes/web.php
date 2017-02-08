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

/* USERS */
Route::get('/user/{id}', 'UserController@single', ['user' => '{id}']);
Route::get('/user/{id}/delete', 'UserController@delete', ['user' => '{id}']);

/* REALMS */
Route::get('/realm/{id}', 'RealmController@single', ['realm' => '{id}'])->name('realm');
Route::get('/realm/{realm}/edit/', 'RealmController@editor', ['realm' => '{realm}']);

Route::get('/realm-create', 'RealmController@creator');

Route::post('/realm-save', 'RealmController@create');

/* CONTINENTS */
Route::get('/continent/{id}', 'ContinentController@single', ['continent' => '{id}'])->name('continent');
Route::get('/continent-edit/{continent}', 'ContinentController@editor', ['oContinent' => '{continent}'])->name('continent-edit');

Route::get('/continent-create', 'ContinentController@creator');
Route::get('/continent-create/{id}', 'ContinentController@creator', ['realmID' => '{id}']);

Route::post('/continent-save', 'ContinentController@create');

/* LANDSCAPES */
Route::get('/landscape/{id}', 'LandscapeController@single', ['landscape' => '{id}'])->name('landscape');
Route::get('/landscape/{id}/edit/', 'LandscapeController@editor', ['oContinent' => '{id}']);

/* LARGE CITIES */
Route::get('/large-city/{id}', 'LargeCityController@single', ['largeCity' => '{id}'])->name('large-city');

/* MEDIUM CITIES */
Route::get('/medium-city/{id}', 'MediumCityController@single', ['mediumCity' => '{id}'])->name('medium-city');

/* SMALL CITIES */
Route::get('/small-city/{id}', 'SmallCityController@single', ['smallCity' => '{id}'])->name('small-city');

/* PLACES */
Route::get('/place/{id}', 'PlaceController@single', ['place' => '{id}'])->name('place');

/* FORM ACTIONS */
Route::POST('/realm/{id}/save', 'RealmController@save', ['realm' => '{id}']);
Route::POST('/continent/{id}/save', 'ContinentController@save', ['oContinentID' => '{id}']);
Route::POST('/landscape/{id}/save', 'LandscapeController@save', ['iLandscapeID' => '{id}']);