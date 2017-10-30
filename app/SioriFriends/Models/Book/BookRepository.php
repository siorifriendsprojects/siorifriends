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

    public function findByUserAccount(string $account);

    public function fetchNewBooks(int $limit);

    public function add(Book $book);

    public function save(Book $book);

    public function remove(Book $book);
}
