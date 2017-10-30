<?php

use Illuminate\Http\Request;
use App\Http\Middleware\OnceAuth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    Route::get('/users', 'UserController@index');

    //TODO:認証が必要なAPIの例 何か変わりに書いたら削除して
    Route::middleware(OnceAuth::class)->post('/authuser', function(Request $request){
        return json_encode(Auth::user());
    });
});
