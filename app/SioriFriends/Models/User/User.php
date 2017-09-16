<?php

namespace App\Siorifriends\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Alsofronie\Uuid\Uuid32ModelTrait;

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
    public $timestamps   = false;

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * このユーザと本の一対多の関連を定義
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function follow()
    {
        return $this->hasMany(Follow::class);
    }

    /**
     *
     *
     * @return \Illuminate\Support\Collection
     */
    public function follower()
    {
        return Follow::where('follow_id', '=', $this->id)->all();
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
