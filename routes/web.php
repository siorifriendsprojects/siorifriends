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

//Twitter
Route::get('login/twitter', 'Auth\LoginController@getTwitterAuth');
Route::get('home', 'Auth\loginController@getTwitterAuthCallback');

//Google
Route::get('login/google','Auth\LoginController@getGoogleAuth');
Route::get('home','Auth\LoginController@getGoogleAuthCallback');


Route::get('/tags',function(){
    return view('tags');
});

Route::get('/books/search','BookController@search')->name('search');

Route::post('/books/{bookId}/comment/create','BookController@addComment')->name('addComment');

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
