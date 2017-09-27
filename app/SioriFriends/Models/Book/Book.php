<?php

namespace App\SioriFriends\Models\Book;

use App\SioriFriends\Models\User\Favorite;
use App\SioriFriends\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\Uuid32ModelTrait;

class Book extends Model
{
    use Uuid32ModelTrait;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
//    public $timestamps   = false;

    /**
     * 本の製作者を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * この本をお気に入りしたユーザの一覧を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this
            ->belongsToMany(User::class, 'favorites')
            ->using(Favorite::class)
            ->withPivot('created_at');
    }

    /**
     * この本に付いているタグの一覧を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this
            ->belongsToMany(Tag::class)
            ->using(BookTag::class)
            ->withPivot('created_at');
    }

    /**
     * この本にタグを追加する。
     *
     * @param Tag $tag
     */
    public function addTag(Tag $tag): void
    {
        $this->tags()->attach($tag->id);
    }

    /**
     * この本からタグを除去する。
     *
     * @param Tag $tag
     */
    public function removeTag(Tag $tag): void
    {
        $this->tags()->detach($tag->id);
    }

    /**
     * この本の link の一覧を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function anchors()
    {
        return $this
            ->belongsToMany(Anchor::class)
            ->using(AnchorBook::class)
            ->withPivot('created_at');
    }

    /**
     * アンカーを追加する。
     *
     * @param Anchor $anchor
     */
    public function addAnchor(Anchor $anchor)
    {
        $this->anchors()->attach($anchor->id);
    }

    /**
     * アンカーを除去する。
     *
     * @param Anchor $anchor
     */
    public function removeAnchor(Anchor $anchor)
    {
        $this->anchors()->detach($anchor->id);
    }

    /**
     * この本のコメントの一覧を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * この本にコメントを追加する。
     *
     * @param User $user
     * @param string $comment
     * @return Model 追加したコメントオブジェクト。
     */
    public function addComment(User $user, string $comment)
    {
        return $this->comments()->create([
            'user_id' => $user->id,
            'book_id' => $this->id,
            'body' => $comment,
        ]);
    }
}
