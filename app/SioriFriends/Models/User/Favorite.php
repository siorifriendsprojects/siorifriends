<?php

namespace App\Siorifriends\Models\User;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

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
