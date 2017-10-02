<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/10/02
 * Time: 14:18
 */

namespace App\SioriFriends\Models\Book;


use Illuminate\Database\Eloquent\Model;

interface BookRepository
{
    public function findAll();

    public function findById(string $bookId);

    public function add(Model $book);

    public function save(Model $book);

    public function remove(Model $book);
}
