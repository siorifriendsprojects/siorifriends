<?php

use Illuminate\Database\Seeder;
use App\SioriFriends\Models\User\User;
use App\SioriFriends\Models\User\Profile;
use App\SioriFriends\Models\Book\Tag;
use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\Anchor;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create test user.
        $testUser = factory(User::class)->create([
            'account'   => 'test account',
            'name'      => 'test name',
            'email'     => 'test@gmail.com',
            'password'  => bcrypt('test'),
        ]);

        // create profile of test user.
        $testUserProfile = factory(Profile::class)->create([
            'user_id' => $testUser->id,
        ]);

        // add follow follower relationship.
        $users = factory(User::class, 3)->create();
        foreach($users as $user) {
            $testUser->follow($user); // follow
            $user->follow($testUser); // follower
        }

        // create tags.
        $tags = collect(['test', 'sample', 'siori', 'dev', 'おいしい水'])->map(function(string $name) {
            return factory(Tag::class)->create([ 'name' => $name ]);
        });

        // create anchors.
        $anchors = collect([
            ['url' => 'https://translate.google.com', 'title' => 'Google翻訳'],
            ['url' => 'https://github.com', 'title' => 'Github'],
            ['url' => 'https://qiita.com', 'title' => 'Qiita'],
        ])->map(function(array $link) {
            return [
                'url' => factory(Anchor::class)->create([ 'url' => $link['url'] ]),
                'title' => $link['title'],
            ];
        });

        // create books of test user.
        $testUserBooks = factory(Book::class, 5)->create([
            'user_id' => $testUser->id,
        ])->map(function (Book $book) use ($tags) {
            foreach ($tags as $tag) $book->addTag($tag);
            return $book;
        })->map(function (Book $book) use ($anchors) {
            foreach ($anchors as $link) $book->addAnchor($link['url'], $link['title']);
            return $book;
        });

        // do favorite first book of test user.
        foreach ($users as $user) {
            $user->addFavorite($testUserBooks[0]);
        }
    }
}
