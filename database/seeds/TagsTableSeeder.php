<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\Book\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class)->create();
    }
}
