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

/* PROTECTED ROUTES */
Route::group(['middleware' => 'auth'], function () {

    /* CREATE ROUTES */
    Route::get('/{model}/creator/', 'Controller@creator');
    Route::get('/{model}/creator/{parent}', 'Controller@creator');
    Route::post('/{model}/create/', 'Controller@baseCreate');

    /* EDIT ROUTES */
    Route::get('/{model}/editor/{name}', 'Controller@editor');
    Route::post('/{model}/save/{name}', 'Controller@baseSave');

    /* DISPLAY ROUTES */
    Route::get('/{model}/{name}', 'Controller@single')->name('single');
});