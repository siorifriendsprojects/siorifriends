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

Route::get('/privacy',function(){
    return view('privacy');
});


/*
ここのまとまりより下には/{id}/から始まらないルーティングを追加しないでください。
理由->/{id}/のルーティングが優先されて機能しないため
*/
Route::get('/{id}','UserController@show');

Route::get('/{id}/bookshelf',function(){
    return view("bookshelf");
});

Route::get('/{id}/follow','UserController@showFollow');

Route::get('/{id}/follower','UserController@showFollower');