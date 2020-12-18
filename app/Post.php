<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $fillable = [
        'titulo', 'texto_largo', 'texto_corto', 'slug', 'user_id', 'categoria_id', 'imagen',
    ];
}
