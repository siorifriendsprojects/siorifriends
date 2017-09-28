<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(FollowsTableSeeder::class);

        $this->call(TagsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(AnchorsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
