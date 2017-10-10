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

/* AUTH */
Route::group(['middleware'=>'setTheme:Lore'], function() {
    Auth::routes();

    /* AUTH ROUTES */
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});

/* ALL OTHER */
Route::group(['middleware'=>['setTheme:Lore', 'auth']], function() {

    /* MAIN ROUTES */
    Route::get('/search', 'SearchController@search');

    Route::get('/', function (){
       return view('index');
    })->middleware('auth')->name('search');

    Route::get('/blog', function (){
        return view('blog', ['posts' => News::all()]);
    })->middleware('auth')->name('blog');

    /* RESOURCE ROUTES */
    Route::resource('item', 'ItemController');
    Route::resource('party', 'PartyController');

    /* SUB-RESOURCE ROUTES */
    Route::get('/entry/create/{party}', 'EntryController@create');
    Route::get('/entry/{entry}/edit', 'EntryController@edit');
    Route::post('/entry', 'EntryController@store');
    Route::put('/entry/{id}', 'EntryController@update');
    Route::delete('/entry/{id}', 'EntryController@destroy');

    /* ADMIN ROUTES */
    Route::group(['prefix' => 'admin', 'name' => 'admin', 'middleware' => 'adminAuth'], function() {
        Route::get('/', function (){
           return view('admin.index');
        });

        Route::get('/items', 'Admin\AdminController@items');
        Route::get('/meta', 'Admin\AdminController@meta');
    });

    /* LIVE MARKDOWN */
    Route::post('/lmark', 'Util\LiveMarkdown@toMarkdown');
});



/*
Route::get('/notifications', 'NotificationController@index')->name('notifications');

Route::resource('category', 'CategoryController');
Route::resource('tag', 'TagController');
Route::resource('property', 'PropertyController');

Route::resource('news', 'NewsController');
Route::resource('user', 'UserController');

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
*/
