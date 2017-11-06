<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SioriFriends\Models\User\UserRepository;
use App\SioriFriends\Models\User\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class BookShelfController extends Controller
{
    private $users;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->users = $userRepository;
    }    

    /**
     * bookshelf page を返すメソッド。
     *
     * @param string $account ユーザのアカウント
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
     public function showBooks(string $account)
     {
         try {
             $user = $this->users->findByAccount($account);
             return view('bookshelf',[ 'books' => $user->books()->get()]);
         } catch (ModelNotFoundException $exception) {
             abort(404, 'User not found.');
         }
     }
 
}
