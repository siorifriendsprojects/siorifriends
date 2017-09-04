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



/*
ここのまとまりより下には/{id}/から始まらないルーティングを追加しないでください。
理由->/{id}/のルーティングが優先されて機能しないため
*/
Route::get('/{id}','UserController@show');

Route::get('/{id}/follow','UserController@showFollow');

Route::get('/{id}/follower','UserController@showFollower');