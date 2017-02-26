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

Route::get('/dashboard', 'HomeController@index');

Auth::routes();

Route::get('/', 'HomeController@index');

/* create new child object */
Route::get('/{childModel}/create/{parentModel}/{parentUrl}', function($sChildModel, $sParentModel, $sParentURL = null){
    $sChild = 'App\Models\\' . ucfirst($sChildModel);
    $sParent = 'App\Models\\' . ucfirst($sParentModel);

    return View::make('models.' . $sChildModel .'.create', [
        'sMethod' => 'POST',
        'oObject' => new $sChild(),
        'oParent' => $sParent::where('url', $sParentURL)->get()->first()
    ]);
});

/* first level resources */
Route::resource('user', 'UserController');
Route::resource('realm', 'RealmController');

/* second level resource */
Route::resource('continent', 'ContinentController');
Route::resource('empire', 'EmpireController');
Route::resource('ocean', 'OceanController');
Route::resource('island', 'IslandController');

/* third level resource */
Route::resource('landscape', 'LandscapeController');
Route::resource('sea', 'SeaController');

/* fourth level resource */
Route::resource('city', 'CityController');
Route::resource('river', 'RiverController');
Route::resource('lake', 'LakeController');
Route::resource('biome', 'BiomeController');
Route::resource('landmark', 'LandmarkController');
Route::resource('mountain', 'MountainController');