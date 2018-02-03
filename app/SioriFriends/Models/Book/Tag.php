<?php

namespace App\SioriFriends\Models\Book;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\Uuid32ModelTrait;

class Tag extends Model
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
    public $timestamps   = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        Tag::CREATED_AT,
    ];

    public function books()
    {
        return $this
            ->belongsToMany(Book::class)
            ->using(BookTag::class)
            ->withPivot(BookTag::CREATED_AT);
    }
}
