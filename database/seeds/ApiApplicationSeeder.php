<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\Api\ApiApplication;
use App\SioriFriends\Models\User\User;

class ApiApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sioriFriendsSystem = factory(User::class)->create([
            'account'   => bcrypt('SioriFriends'),
            'name'      => 'SioriFriends',
            'email'     => 'system@siorifriends.net',
            'password'  => bcrypt(hash('sha256','SioriFriends')),
        ]);

        $sioriFriendsApp = factory(ApiApplication::class)->create([
            'id'        => '0000000000siorifriends0000000000',
            'name'      => 'Siori Friends',
            'user_id'     => $sioriFriendsSystem->id,
            'description'  => 'siori friends system',
            'url' => 'http://localhost/'
        ]);
    }
}
