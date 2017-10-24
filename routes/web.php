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

Route::resource('/books', 'BookController', [
    'parameters' => [
        'book' => 'bookId'
    ]
]);


Route::prefix('/users')->group(function() {
    Route::get('/',function(){
        return view('users');
    });

    Route::get('/{account}', 'User\ProfileController@show')->name('overview');

    Route::get('/{account}/follow','User\FollowController@showFollows');

    Route::get('/{account}/follower','UserController@showFollower');

    Route::get('/{account}/bookshelf','User\BookShelfController@showBooks');

    Route::get('/{account}/favorite',function(){
        return view('favorite');
    });

    Route::get('/{account}/{bookId}',function(){
        return view('book');
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
