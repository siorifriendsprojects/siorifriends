<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/10/09
 * Time: 15:58
 */

namespace App\SioriFriends\Models\Book;


use App\Http\Requests\CreateBookPost;
use App\SioriFriends\Models\User\User;
use App\SioriFriends\Models\Book\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BookFactory
{
    public static function create(array $request, User $author)
    {
        // 本の生成
        $book = $author->books()->create([
            'user_id' => $author->id,
            'title'   => $request['title'],
            'description' => $request['description'],
            'is_publishing' => $request['is_publishing'] ?? true,
            'is_commentable' => $request['is_commentable'] ?? true,
        ]);

        // tag の追加
        foreach ($request['tags'] as $tagName) {
            $tag = Tag::firstOrCreate([ 'name' => $tagName ]);
            $book->addTag($tag);
        }

        // anchor の追加
        foreach ($request['anchors'] as $hash) {
            $anchor = Anchor::firstOrCreate(['url' => $hash['url'] ]);
            $book->addAnchor($anchor, $hash['name']);
        }

        return $book;
    }
}
