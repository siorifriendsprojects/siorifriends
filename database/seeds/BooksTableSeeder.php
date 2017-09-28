<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\User\User;
use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\Tag;
use App\SioriFriends\Models\Book\Anchor;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function($user) {
            factory(Book::class, random_int(0, 5))->create([
                'user_id' => $user->id,
            ])->each(function(Book $book) {
                $tags = Tag::all()->random(random_int(1, 5));
                foreach($tags as $tag) {
                    $book->addTag($tag);
                }
            });
        });
    }
}
