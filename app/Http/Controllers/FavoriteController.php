<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SioriFriends\Models\Book\BookRepository;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct(BookRepository $books)
    {
        $this->books = $books;
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
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $book = $this->books->findById($request["bookId"]);

        if ($book->isFavorite(Auth::user()))
            return json_encode(['message' => 'already favorited']);

        Auth::user()->addFavorite($book);
        return json_encode(['message' => 'create favorite success']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $account
     * @return \Illuminate\Http\Response
     */
    public function show($account)
    {
        try {
            $tmpBooks = $this->books->findFavoritesByUserAccount($account);
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
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $book = $this->books->findById($request["bookId"]);

        if (false == $book->isFavorite(Auth::user()))
            return json_encode(['message' => 'already unfavorited']);

        Auth::user()->removeFavorite($book);

        return json_encode(['message' => 'unfavorite success']);
    }
}
