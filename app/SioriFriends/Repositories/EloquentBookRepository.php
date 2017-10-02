<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/10/02
 * Time: 14:23
 */

namespace App\SioriFriends\Repositories;


use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\BookRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentBookRepository implements BookRepository
{
    /**
     * 本を追加する。
     *
     * @param Model $book
     */
    public function add(Model $book)
    {
        $book->save();
    }

    /**
     * 本の一覧を返す。
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return Book::all();
    }

    /**
     * id で本を取得する。
     *
     * @param string $bookId
     * @return mixed
     * @throws ModelNotFoundException 本が見つからなかった場合。
     */
    public function findById(string $bookId)
    {
        return Book::findOrFail($bookId);
    }

    /**
     * 本の変更を保存する。
     *
     * @param Model $book
     */
    public function save(Model $book)
    {
        $book->save();
    }

    /**
     * 本を削除する.
     *
     * @param Model $book
     */
    public function remove(Model $book)
    {
        $book->delete();
    }
}