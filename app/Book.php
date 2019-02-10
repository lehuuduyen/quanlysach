<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";
    protected $fillable = [
        'title', 'description', 'content',
        'author', 'status','image','is_order','sum'
    ];
}
