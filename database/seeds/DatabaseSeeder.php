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
        $this->call(BooksTableSeeder::class);
    }
}
