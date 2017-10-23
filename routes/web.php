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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tags',function(){
    return view('tags');
});


Route::prefix('/users/{account}')->group(function() {
    Route::get('/', 'User\ProfileController@show')->name('overview');

    Route::get('/follow','User\FollowController@showFollows');
    Route::get('/follower','UserController@showFollower');
    Route::get('/bookshelf','User\BookShelfController@showBooks');

    Route::get('/favorite',function(){
        return view('favorite');
    });

    Route::resource('/books', 'BookController');
});


Route::get('/notifications',function(){
    return view('notify');
});

Route::get('/search',function(){
    return view('search');
});

Route::get('/settings',function(){
    return view('settings');
});

Route::get('/terms',function(){
    return view('terms');
});

Route::get('/privacy',function(){
    return view('privacy');
});

Route::get('/help',function(){
    return view('help');
});
