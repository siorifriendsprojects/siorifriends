<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\Book\Tag;

class TagsTableSeeder extends Seeder
{
    /** @var int どれだけ生成するか */
    private const AMOUNT = 15;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class, self::AMOUNT)->create();
    }
}
