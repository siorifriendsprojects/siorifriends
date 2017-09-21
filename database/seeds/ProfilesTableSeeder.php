<?php

use Illuminate\Database\Seeder;
use App\Siorifriends\Models\User\User;
use App\Siorifriends\Models\User\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function($user) {
            factory(Profile::class)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
