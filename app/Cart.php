<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = "id";
    protected $fillable = [
        'qty',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'fk_product');
    }
}
