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

Auth::routes();

Route::get('/tags',function(){
    return view('tags');
});

Route::get('/books/search','BookController@search')->name('search');

Route::resource('/books', 'BookController', [
    'parameters' => [
        'book' => 'bookId'
    ]
]);

Route::prefix('/users/{account}')->group(function() {
    Route::get('/', 'User\ProfileController@show')->name('overview');

    Route::get('/follows','User\FollowController');
    Route::get('/followers','User\FollowerController');
    Route::get('/bookshelf','User\BookShelfController@index')->name('bookshelf');
    Route::get('/favorite','FavoriteController@show')->name('favorite');
});


Route::get('/notifications',function(){
    return view('notify');
});

Route::middleware("auth")->get('/settings',function(){
    return view('user.settings');
})->name("settings");

Route::post('/settings','User\ProfileController@update');

Route::get('/terms',function(){
    return view('terms');
});

Route::get('/privacy',function(){
    return view('privacy');
});

Route::get('/help',function(){
    return view('help');
});

Route::get('/logined',function(){
    return view('logined');
});