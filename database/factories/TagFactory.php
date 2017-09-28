<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/09/28
 * Time: 13:16
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\SioriFriends\Models\Book\Tag::class, function (Faker\Generator $faker) {
    // 生成した uuid から, '-' を除去する。
    $uuid = preg_replace('/-/', '', $faker->unique()->uuid);

    return [
        'id' => $uuid,
        'name' => $faker->unique()->word,
    ];
});
