<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'descr', 'price', 'shipping_price', 'image_path',
    ];

}
