<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Follow;
use Alsofronie\Uuid\Uuid32ModelTrait;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
        return view('profile',['user' => User::where('account','=',$id)->firstOrFail()]);
     }

    /**
     * idで指定されたユーザのフォローを表示。
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showFollow($id)
     {
        try{
            $user = User::where('account','=',$id)->firstOrFail();
            $followUser = User::whereIn('id', Follow::select('follow_id')->where('user_id','=',$user->id)->get()->toArray() );

            return view('follow',['user' => $user,'followUsers' => $followUser->get()]);            
        }catch(Exception $e) {
            return $e->getMessage();
        }
//        return $followUser->get()->toArray();
     }

     /**
     * idで指定されたユーザのフォロワーを表示。
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showFollower($id)
     {
        return view('follower');        
     }

}
