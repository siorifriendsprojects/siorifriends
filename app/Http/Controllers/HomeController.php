<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\BookRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookRepository $books)
    {
        $this->books = $books;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newBooks = [];
        foreach($this->books->fetchNewBooks(5)->get() as $book){
            $newBooks[] = [
                'id' => $book->id,
                'title' => $book->title,
                'description' => $book->description,
                'icon_path' => $book->author->profile->icon_path
            ];
        }

        return view('home',['newBooks' => $newBooks]);
    }
}
