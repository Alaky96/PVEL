<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'descr', 'price', 'shipping_price', 'image_path',
    ];


    public function supplier()
    {
        return $this->belongsTo('App\User', 'fk_owner');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'fk_category');
    }



}
