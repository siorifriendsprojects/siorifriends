<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookPost;
use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\BookFactory;
use App\SioriFriends\Models\Book\BookRepository;
use App\SioriFriends\Models\User\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /** @var UserRepository */
    private $users;

    /** @var BookRepository */
    private $books;

    public function __construct(UserRepository $userRepository, BookRepository $bookRepository)
    {
        $this->users = $userRepository;
        $this->books = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookPost $request)
    {
        $author = $this->users->findById(Auth::id());
        $book = BookFactory::create($request->all(), $author);

        return view('books.show', [ 'book' => $book ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $bookId
     * @return \Illuminate\Http\Response
     */
    public function show($bookId)
    {
        try {
            $book = $this->books->findById($bookId);
            return view('books.show', [ 'book' => $book ]);
        } catch(ModelNotFoundException $e) {
//            throwException($e::class);
            abort(404, $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
