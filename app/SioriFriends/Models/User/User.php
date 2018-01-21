<?php

namespace App\SioriFriends\Models\User;

use App\SioriFriends\Models\Api\ApiToken;
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
            ->withPivot(Follow::CREATED_AT);
    }


    /**
     * フォロワーの一覧を取得する。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this
            ->belongsToMany(User::class, 'follows', 'follow_id', 'user_id')
            ->using(Follow::class)
            ->withPivot(Follow::CREATED_AT);
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
            ->belongsToMany(Book::class, 'favorites')
            ->using(Favorite::class)
            ->withPivot(Favorite::CREATED_AT);
    }

    /**
     * 本をお気に入りに登録する。
     *
     * @param Book $book
     * @return void
     */
    public function addFavorite(Book $book): void
    {
        $this->favorites()->attach($book->id);
    }

     /**
      * 本のお気に入りを解除する。
      *
      * @param Book $book
      * @return void
      */
    public function removeFavorite(Book $book): void
    {
        $this->favorites()->detach($book->id);
    }



    /**
     * ユーザをフォローする。
     *
     * @param User $user
     * @return void
     */
    public function follow(User $user): void
    {
        $this->follows()->attach($user->id);
    }

    /**
     * ユーザのフォローを解除する。
     *
     * @param User $user
     * @void
     */
    public function unFollow(User $user): void
    {
        $this->follows()->detach($user->id);
    }

    /**
     * ユーザをフォローしているかどうか
     *
     * @param User $user
     * @return bool フォローしていればtrueを返す。
     */
    public function isFollow(User $user): bool
    {
        return $this->follows()
            ->where('id', $user->id)
            ->exists();
    }

    /**
     * 栞フレンズ内で使用するAPITokenを返す
     */
    public function localToken(){
        $apiToken = ApiToken::where('user_id',Auth::id())->where('application_id','0000000000siorifriends0000000000');

        if ($apiToken->exists()){
            return $apiToken->first();
        }else{
            $apiToken = new ApiToken();
            $apiToken->user_id = Auth::id();
            $apiToken->application_id = '0000000000siorifriends0000000000';
            $apiToken->token = hash('sha256',(Auth::user()->account).'0000000000siorifriends0000000000');
            $apiToken->expire = date("Y-m-d H:i:s",time() + (14 * 24 * 60 * 60));

            $apiToken->save();

            return $apiToken;
        }
    }

}
