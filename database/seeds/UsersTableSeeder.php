<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\User\User;

class UsersTableSeeder extends Seeder
{
    /** @var int どれだけ生成するか */
    private const AMOUNT = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, self::AMOUNT)->create();
    }
}
