<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateBookPost;
use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\Anchor;
use App\SioriFriends\Models\Book\Tag;

class BookController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return view('book',['book' => Book::where('id','=',$id)->firstOrFail()]);
    }

    /**
     * bookを作成します
     */
    public function create(CreateBookPost $request)
    {
        $book = new Book();
        $book->user_id = Auth::id();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->is_publishing = $request->input('book.is_publishing',true);
        $book->is_commentable = $request->input('book.is_commentable',true);
        $book->save();

        collect($request->input('book.anchors'))->each(function($item,$key){
            $book->addAnchor(Anchor::firstOrCreate(['url' => $item->url]),$item->name);
        });

        collect($request->input("book.tags"))->each(function($item,$key){
            $book->addTag(Tag::firstOrCreate(['name' => $item]));
        });

        return redirect('books/'+$book->id);
    }

}
