<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserRepositoryInterface;
use App\Infrastructure\Eloquent\User;
use App\Follow;

class UserController extends Controller
{
  
    private $user_repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->user_repository = $repository;
    }

    public function index()
    {
        return $this->user_repository->findAll()->toJson();
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
