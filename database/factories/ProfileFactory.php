<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/09/20
 * Time: 1:19
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\SioriFriends\Models\User\Profile::class, function (Faker\Generator $faker) {

    // 生成した uuid から, '-' を除去する。
    $uuid = preg_replace('/-/', '', $faker->unique()->uuid);
    return [
        'id' => $uuid,
        'user_id' => function() {
            return factory(\App\SioriFriends\Models\User\User::class)->create()->id;
        },
        'icon_path' => function(array $profile) {
            return '/img/icons/' . $profile['user_id'] . '.jpg';
        },
        'intro' => $faker->text(),
        'birthday' => $faker->date(),
        'gender' => $faker->randomElement(['男', '女', '鳥', '猫']),
        'twitter' => '',
        'facebook' => '',
        'instagram' => ','
    ];
});
