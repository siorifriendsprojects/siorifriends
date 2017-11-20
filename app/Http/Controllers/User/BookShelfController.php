<?php

namespace App\Http\Controllers\User;

use App\SioriFriends\Models\Book\BookRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SioriFriends\Models\User\UserRepository;
use App\SioriFriends\Models\User\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class BookShelfController extends Controller
{
    private $books;
    
    public function __construct(BookRepository $bookRepository)
    {
        $this->books = $bookRepository;
    }    

    /**
     * ユーザの一覧を表示する
     *
     * @param string $account ユーザのアカウント名
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
     public function index(string $account)
     {
         try {
             $tmpBooks = $this->books->findByUserAccount($account);
             $books = [];
             foreach($tmpBooks as $book){
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
