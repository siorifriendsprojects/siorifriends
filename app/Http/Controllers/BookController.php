<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookPost;
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
     * @param  \App\Http\Requests\StoreBookPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookPost $request)
    {
        try {
            // request が本の仕様を満たしているかどうか
            $bookSpec = new BookSpec($request);
            // login user model の取得
            $author = $this->users->findById(Auth::id());
            $book = BookFactory::create($author, $bookSpec);

            //作成した本のページヘリダイレクトする
            $to = route('books.show', [ 'bookId' => $book->id ]);
            return redirect($to);
        } catch (ModelNotFoundException $e) {
            abort(404, $e->getMessage());
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
            // ログインしている、かつ、本の作者
            $isMyBook = Auth::check() && $book->author->id === Auth::id();

            return view('books.show', [
                'book' => $book,
                'isMyBook' => $isMyBook
            ]);
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
        try {
            $book = $this->books->findById($bookId);
            $author = $book->author;

            // ゲストユーザの場合、または、本の作者ではない場合はエラー
            if (Auth::guest() || $author->id !== Auth::id()) {
                abort(403, 'You do not have access authority.');
            }

            $this->books->remove($book);

            // ユーザの本の一覧へリダイレクト
            $to = route('bookshelf', [ 'account' => $author->account ]);
            return redirect($to);
        } catch (ModelNotFoundException $e) {
            abort(404, 'Not found this resource.');
        }
    }
}
