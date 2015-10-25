<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //only these fields can be updated
    //for security
    protected $fillable = [
        'title',
        'body',
        'published_at'
    ];
}
