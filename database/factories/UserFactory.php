<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/09/17
 * Time: 22:32
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Siorifriends\Models\User\User::class, function (Faker\Generator $faker) {
    static $password;

    // 生成した uuid から, '-' を除去する。
    $uuid = preg_replace('/-/', '', $faker->unique()->uuid);
    return [
        'id' => $uuid,
        'account' => $faker->unique()->name,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
