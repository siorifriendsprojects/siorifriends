<?php

namespace App\Siorifriends\Models\Book;

use Illuminate\Database\Eloquent\Model;

class AnchorBook extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anchor_book';

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
