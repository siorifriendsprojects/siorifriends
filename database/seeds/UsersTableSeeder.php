<?php

use Illuminate\Database\Seeder;
use App\Infrastructure\Eloquents\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'account' => str_random(10),
            'name'    => str_random(10),
            'email'   => str_random(10) . '@gmail.com',
            'password' => bcrypt('4423'),
        ]);
    }
}
