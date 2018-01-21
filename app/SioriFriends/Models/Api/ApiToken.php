<?php

namespace App\SioriFriends\Models\Api;

use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    protected $fillable = [
        'token','expire'
    ];
}
