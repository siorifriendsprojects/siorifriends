<?php

namespace App\Http\Controllers;

use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\BookFactory;
use App\SioriFriends\Models\Book\BookRepository;
use App\SioriFriends\Models\Book\BookSpec;
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
    public function store(Request $request)
    {
        if (Auth::guest()) {
            abort(401, 'Please register or login.');
        }

        try {
            // request が本の仕様を満たしているかどうか
            $bookSpec = new BookSpec($request->all());
            // login user model の取得
            $author = $this->users->findById(Auth::id());
            $book = BookFactory::create($bookSpec, $author);

            return view('books.show', [ 'book' => $book ]);
        } catch(\InvalidArgumentException $e1) {
            abort(400, $e1->getMessage());
        } catch (ModelNotFoundException $e2) {
            abort(404, $e2->getMessage());
        }
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
     * @param  string  $bookId
     * @return \Illuminate\Http\Response
     */
    public function edit($bookId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $bookId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bookId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $bookId
     * @return \Illuminate\Http\Response
     */
    public function destroy($bookId)
    {
        //
    }
}
