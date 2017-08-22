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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/enter', function (){
    $user = new \App\User();
    $user->username = "TEST";
    $user->passsword = bcrypt("test");
    $user->group = 0;
    $user->save();

   \Illuminate\Support\Facades\Auth::login($user);

   return view('dashboard', ['news' => \App\News::all()]);
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/settings', 'SettingsController@index')->name('settings');
Route::get('/notifications', 'NotificationController@index')->name('notifications');

//Route::post('/notifications/{id}/read', 'NotifiationControler@read');
Route::post('search', 'SearchController@index');
Route::post('find', 'SearchController@find');

Route::resource('item', 'ItemController');
Route::resource('category', 'CategoryController');
Route::resource('tag', 'TagController');
Route::resource('property', 'PropertyController');

Route::resource('news', 'NewsController');
Route::resource('user', 'UserController');

Route::resource('notification', 'NotificationController');