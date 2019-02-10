<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'book_id', 'rate',
         'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
