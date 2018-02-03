<?php
/**
 * Created by PhpStorm.
 * User: as-is-prog
 * Date: 17/12/04
 * Time: 19:25
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\SioriFriends\Models\Api\ApiApplication::class, function (Faker\Generator $faker) {
    // 生成した uuid から, '-' を除去する。
    $uuid = preg_replace('/-/', '', $faker->unique()->uuid);

    return [
        'id' => $uuid,
        'name' => $faker->sentence,
        'user_id' => function() {
            return factory(\App\SioriFriends\Models\User\User::class)->create()->id;
        },
        'description' => $faker->text,
        'url' => $faker->url,
    ];
});
