<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'title', 'description', 'rate',
        'is_rate', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
