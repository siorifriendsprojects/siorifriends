<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/09/17
 * Time: 22:59
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\SioriFriends\Models\Book\Book::class, function (Faker\Generator $faker) {
    // 生成した uuid から, '-' を除去する。
    $uuid = preg_replace('/-/', '', $faker->unique()->uuid);

    return [
        'id' => $uuid,
        'user_id' => function() {
            return factory(\App\SioriFriends\Models\User\User::class)->create()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->text,
        'is_publishing' => $faker->boolean(),
    ];
});
