<?php

use Illuminate\Database\Seeder;
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
        factory(Anchor::class)->create();
    }
}
