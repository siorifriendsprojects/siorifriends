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
     * この本のコメントの一覧を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
