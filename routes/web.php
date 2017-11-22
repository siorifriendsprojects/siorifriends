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

    Route::get('/favorite',function(){
        return view('favorite');
    });
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
