<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\User\User;
use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\Tag;
use App\SioriFriends\Models\Book\Anchor;

class BooksTableSeeder extends Seeder
{
    /** @var \Faker\Generator */
    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = \Faker\Factory::create('ja_JP');

        User::all()->each(function($user) {
            factory(Book::class, random_int(0, 5))->create([
                'user_id' => $user->id,
            ])->each(function(Book $book) {
                Tag::all()
                    ->random(random_int(1, 5))
                    ->each(function(Tag $tag) use ($book) { $book->addTag($tag); });

                Anchor::all()
                    ->random(random_int(1, 10))
                    ->each(function(Anchor $anchor) use ($book) {
                        $book->addAnchor($anchor, $this->faker->sentence(3));
                    });
            });
        });
    }
}
