<?php

use Illuminate\Database\Seeder;
use App\Siorifriends\Models\User\User;
use App\Infrastructure\Eloquents\Book;

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
            collect(range(1, 10))->each(function($num) use ($user) {
                Book::create([
                    'user_id' => $user->id,
                    'title'   => str_random(),
                    'description' => str_random(),
                    'is_publishing' => true,
                ]);
            });
        });
    }
}
