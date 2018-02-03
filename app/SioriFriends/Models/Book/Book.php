<?php

namespace App\SioriFriends\Models\Book;

use App\SioriFriends\Models\User\Favorite;
use App\SioriFriends\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\Uuid32ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use Uuid32ModelTrait;
    use SoftDeletes;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'is_publishing', 'is_commentable'
    ];

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = [
        self::CREATED_AT,
        self::UPDATED_AT,
        'deleted_at',
    ];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'is_publishing' => 'boolean',
        'is_commentable' => 'boolean',
    ];

    /**
     * 本の製作者を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
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
            ->withPivot(Favorite::CREATED_AT);
    }

    /**
     * この本を引数で渡されたユーザがお気に入りしているかを返す
     *
     * @param User $user 
     * @return bool お気に入りしていればtrueを返す。
     */
    public function isFavorite(User $user)
    {
        return $this->favorites()
            ->where('id', $user->id)
            ->exists();
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
            ->withPivot(BookTag::CREATED_AT);
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
            ->withPivot('name')
            ->withTimestamps();
    }

    /**
     * アンカーを追加する。
     *
     * @param Anchor $anchor
     * @param string $name ユーザが任意で付けることができるアンカーの名前。
     */
    public function addAnchor(Anchor $anchor, string $name = '')
    {
        $this->anchors()->attach($anchor->id, [
            'name' => $name,
        ]);
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
