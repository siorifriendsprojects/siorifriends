<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/09/28
 * Time: 13:28
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\SioriFriends\Models\Book\Comment::class, function (Faker\Generator $faker) {
    // 生成した uuid から, '-' を除去する。
    $uuid = preg_replace('/-/', '', $faker->unique()->uuid);

    $faker->addProvider(Faker\Provider\ja_JP\Text::class);
    return [
        'id' => $uuid,
        'user_id' => function() {
            return factory(\App\SioriFriends\Models\User\User::class)->create()->id;
        },
        'book_id' => function() {
            return factory(\App\SioriFriends\Models\Book\Book::class)->create()->id;
        },
        'body' => $faker->text(),
    ];
});
