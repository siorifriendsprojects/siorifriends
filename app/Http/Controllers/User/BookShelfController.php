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
             $tmpBooks = $this->users->findByAccount($account)->books()->get();
             $books = [];
             foreach($book as $tmpBooks){
                 $books[] = [
                     'id' => $book->id,
                     'title' => $book->title,
                     'isFavorite' => Auth::check() && $book->isFavorite(Auth::user())
                 ];
             }
             return view('bookshelf',['books' => $books]);
         } catch (ModelNotFoundException $exception) {
             abort(404, 'User not found.');
         }
     }
 
}
