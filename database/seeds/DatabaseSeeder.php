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
        collect(range(1, 10))->each(function($number) {
            $this->call(UsersTableSeeder::class);
        });

        $this->call(ProfilesTableSeeder::class);

        $this->call(FollowsTableSeeder::class);

        collect(range(1, 15))->each(function($number) {
            $this->call(TagsTableSeeder::class);
        });

        collect(range(1, 100))->each(function($number) {
            $this->call(AnchorsTableSeeder::class);
        });

        $this->call(BooksTableSeeder::class);
    }
}
