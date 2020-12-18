<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    //
    protected $fillable = [
        'comentario', 'user_id', 'post_id'
    ];
}
