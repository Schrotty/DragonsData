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
Route::get('/realm-create/{open}', 'RealmController@creator', ['open' => '{open}']);

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

/* RIVERS */
Route::get('/river/{id}', 'RiverController@single', ['river' => '{id}'])->name('river');
Route::get('/river-edit/{river}', 'RiverController@editor', ['oLandscape' => '{river}'])->name('river-edit');

Route::get('/river-create', 'RiverController@creator');
Route::get('/river-create/{id}', 'RiverController@creator', ['iLandscapeID' => '{id}']);

Route::post('/river-save', 'RiverController@create');
Route::POST('/river-save/{id}', 'RiverController@save', ['iLandscapeID' => '{id}']);

/* RIVERS */
Route::get('/lake/{id}', 'LakeController@single', ['river' => '{id}'])->name('lake');
Route::get('/lake-edit/{lake}', 'LakeController@editor', ['oLandscape' => '{lake}'])->name('lake-edit');

Route::get('/lake-create', 'LakeController@creator');
Route::get('/lake-create/{id}', 'LakeController@creator', ['iLandscapeID' => '{id}']);

Route::post('/lake-save', 'LakeController@create');
Route::POST('/lake-save/{id}', 'LakeController@save', ['iLandscapeID' => '{id}']);

/* BIOMES */
Route::get('/biome/{id}', 'BiomeController@single', ['river' => '{id}'])->name('biome');
Route::get('/biome-edit/{biome}', 'BiomeController@editor', ['oLandscape' => '{biome}'])->name('biome-edit');

Route::get('/biome-create', 'BiomeController@creator');
Route::get('/biome-create/{id}', 'BiomeController@creator', ['iLandscapeID' => '{id}']);

Route::post('/biome-save', 'BiomeController@create');
Route::POST('/biome-save/{id}', 'BiomeController@save', ['iLandscapeID' => '{id}']);