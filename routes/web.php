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
Route::get('/realm-edit/{realm}', 'RealmController@editor', ['realm' => '{realm}']);
Route::get('/realm-create', 'RealmController@creator');

Route::post('/realm-save', 'RealmController@create');
Route::POST('/realm-save/{id}', 'RealmController@save', ['realm' => '{id}']);

/* CONTINENTS */
Route::get('/continent/{id}', 'ContinentController@single', ['continent' => '{id}'])->name('continent');
Route::get('/continent-edit/{continent}', 'ContinentController@editor', ['oContinent' => '{continent}'])->name('continent-edit');

Route::get('/continent-create', 'ContinentController@creator');
Route::get('/continent-create/{id}', 'ContinentController@creator', ['realmID' => '{id}']);

Route::post('/continent-save', 'ContinentController@create');
Route::POST('/continent-save/{id}', 'ContinentController@save', ['oContinentID' => '{id}']);

/* LANDSCAPES */
Route::get('/landscape/{id}', 'LandscapeController@single', ['landscape' => '{id}'])->name('landscape');
Route::get('/landscape-edit/{id}', 'LandscapeController@editor', ['oContinent' => '{id}']);

Route::get('/landscape-create', 'LandscapeController@creator');
Route::get('/landscape-create/{id}', 'LandscapeController@creator', ['continentID' => '{id}']);

Route::post('/landscape-save', 'LandscapeController@create');
Route::POST('/landscape-save/{id}', 'LandscapeController@save', ['iLandscapeID' => '{id}']);

/* CITIES */
Route::get('/city/{id}', 'CityController@single', ['city' => '{id}'])->name('city');
Route::get('/city-edit/{city}', 'CityController@editor', ['oLandscape' => '{city}'])->name('city-edit');

Route::get('/city-create', 'CityController@creator');
Route::get('/city-create/{id}', 'CityController@creator', ['iLandscapeID' => '{id}']);

Route::post('/city-save', 'CityController@create');
Route::POST('/city-save/{id}', 'CityController@save', ['iLandscapeID' => '{id}']);