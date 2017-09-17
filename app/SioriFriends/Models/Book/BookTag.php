<?php

namespace App\Siorifriends\Models\Book;

use Illuminate\Database\Eloquent\Model;

class BookTag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'book_tag';

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
}
