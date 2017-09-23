<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\User\User;
use App\SioriFriends\Models\Book\Book;

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
            factory(Book::class, 3)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
