<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\Anchor;

class AnchorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('ja_JP');

        Book::all()->each(function(Book $book) use ($faker) {
            $anchors = factory(Anchor::class, random_int(1, 10))->create();
            foreach($anchors as $anchor) {
                $book->addAnchor($anchor, $faker->sentence(3));
            }
        });
    }
}
