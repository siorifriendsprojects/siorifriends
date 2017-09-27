<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\User\User;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $users->each(function(User $user) use ($users) {
            foreach($users as $followedUser) {
                if ($user->id !== $followedUser->id) {
                    $user->following($followedUser);
                }
            }
        });
    }
}
