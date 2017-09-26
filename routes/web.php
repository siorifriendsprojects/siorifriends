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
    return view('toppage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users',function(){
    return view('users');
});

Route::get('/tags',function(){
    return view('tags');
});

Route::get('/books',function(){
    return view('books');
});

Route::get('/books/new',function(){
    return view('create');
});

Route::get('/users/{id}','UserController@show');

Route::get('/users/{id}/follow','UserController@showFollow');

Route::get('/users/{id}/follower','UserController@showFollower');

Route::get('/users/{id}/bookshelf',function(){
    return view("bookshelf");
});

Route::get('/users/{id}/favorite',function(){
    return view('favorite');
});

Route::get('/users/{id}/{bookid}',function(){
    return view('book');
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
