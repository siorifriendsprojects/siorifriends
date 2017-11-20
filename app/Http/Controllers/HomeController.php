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
        return view('home',['newBooks' => $this->books->fetchNewBooks(5)->get()]);
    }
}
