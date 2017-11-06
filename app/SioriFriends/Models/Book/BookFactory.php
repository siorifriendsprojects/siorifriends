<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/10/09
 * Time: 15:58
 */

namespace App\SioriFriends\Models\Book;


use Carbon\Carbon;
use App\SioriFriends\Models\User\User;

class BookFactory
{
    public static function create(User $author, BookSpec $bookSpec)
    {
        // 本の生成
        $book = $author->books()->create([
            'title'   => $bookSpec->title(),
            'description' => $bookSpec->description(),
            'is_publishing' => $bookSpec->isPublishing(),
            'is_commentable' => $bookSpec->isCommentable(),
        ]);

        // tag の追加
        $now = Carbon::now();
        foreach ($bookSpec->tags() as $tagName) {
            $tag = Tag::firstOrCreate([
                'name' => $tagName,
                Tag::CREATED_AT => $now,
            ]);
            $book->addTag($tag);
        }

        // anchor の追加
        foreach ($bookSpec->anchors() as $hash) {
            $anchor = Anchor::firstOrCreate(['url' => $hash['url'] ]);
            $book->addAnchor($anchor, $hash['name']);
        }

        return $book;
    }
}
