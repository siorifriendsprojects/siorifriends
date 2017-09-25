<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SioriFriends\Models\User\User;
use App\SioriFriends\Models\User\Follow;

class UserController extends Controller
{
  
    public function index()
    {
        return User::all()->toJson();
    }
  
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
            return view('follow',['user' => $user,'followUsers' => $user->follows()->get()]);
        }catch(Exception $e) {
            return $e->getMessage();
        }
     }

     /**
     * idで指定されたユーザのフォロワーを表示。
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showFollower($id)
     {
        try{
            $user = User::where('account','=',$id)->firstOrFail();
            return view('follower',['user' => $user,'followers' => $user->followers()->get()]);
        }catch(Exception $e) {
            return $e->getMessage();
        }
     }

}
