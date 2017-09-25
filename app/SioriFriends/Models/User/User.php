<?php

namespace App\SioriFriends\Models\User;

use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\User\Follow;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Alsofronie\Uuid\Uuid32ModelTrait;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use Uuid32ModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
     * ユーザのプロフィールを取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * フォローしているユーザの一覧を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this
            ->belongsToMany(User::class, 'follows', 'user_id', 'follow_id')
            ->using(Follow::class)
            ->withPivot('created_at');
    }


    /**
     * フォロワーの一覧を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this
            ->belongsToMany(self::class, 'follows', 'follow_id', 'user_id')
            ->using(Follow::class)
            ->withPivot('created_at');
    }

    /**
     * ユーザが作成した本の一覧を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * お気に入りしている本の一覧を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this
            ->belongsToMany(Book::class)
            ->using(Favorite::class)
            ->withPivot('created_at');
    }

    /**
     * 引数で渡されたユーザIdのユーザをフォローする。
     *
     * @param string|array $userId id を一つ、または配列で複数指定する。
     * @return void
     */
    public function followFor($userId): void
    {
        $this->follows()->attach($userId);
    }

    /**
     * 引数で渡されたユーザIdのユーザをフォローを解除する。
     *
     * @param string|array $userId
     * @void
     */
    public function unFollowFor($userId): void
    {
        $this->follows()->detach($userId);
    }

    /**
     * 引数で渡されたidのユーザをフォローしているかどうか
     *
     * @param string $userId
     * @return bool フォロー状態。 フォローしていればtrue
     */
    public function isFollow(string $userId): bool
    {
        return $this->follows()->where('id', $userId)->exists();
    }
}
