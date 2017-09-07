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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/notifications', 'NotificationController@index')->name('notifications');

Route::post('search', 'SearchController@index');
Route::post('find', 'SearchController@find');

Route::resource('item', 'ItemController');
Route::resource('journal', 'JournalController');

Route::get('/entry/create/{party}', 'EntryController@create');
Route::get('/entry/{entry}/edit', 'EntryController@edit');
Route::post('/entry', 'EntryController@store');
Route::put('/entry/{id}', 'EntryController@update');

Route::resource('category', 'CategoryController');
Route::resource('tag', 'TagController');
Route::resource('property', 'PropertyController');

Route::resource('news', 'NewsController');
Route::resource('user', 'UserController');
Route::resource('party', 'PartyController');

Route::resource('notification', 'NotificationController');
Route::resource('settings', 'SettingsController');
Route::resource('whitelist', 'WhitelistController');

Route::get('password-reset/{id}', 'UserController@resetPassword');

Route::get('/profile', function(){
    return view('user.show', ['user' => Auth::user()]);
});

Route::put('/account/{id}', 'UserController@updateAccountDetails');
Route::get('/account', function(){
   return view('account', ['user' => Auth::user()]);
});

Route::get('/maintenance/edit', 'MaintenanceController@edit');
Route::get('/maintenance/change', 'MaintenanceController@changeStatus');
Route::put('/maintenance', 'MaintenanceController@update');

