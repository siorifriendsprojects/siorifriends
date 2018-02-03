<?php

namespace App\SioriFriends\Models\Book;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\Uuid32ModelTrait;
use App\SioriFriends\Models\User\User;

class Comment extends Model
{
    use Uuid32ModelTrait;

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
        'user_id', 'book_id', 'body',
    ];

    /**
     * このコメントをしたユーザを取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commentUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
