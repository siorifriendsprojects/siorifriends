<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\Comment;
use App\SioriFriends\Models\User\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::all()->each(function(Book $book) {
            foreach(range(0, random_int(0, 10)) as $__) {
                $user = User::all()->random();

                factory(Comment::class)->create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                ]);
            }
        });
    }
}
