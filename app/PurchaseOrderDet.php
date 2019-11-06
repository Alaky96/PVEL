<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDet extends Model
{
    protected $table = 'purchase_order_dets';

    public function vendor()
    {
        return $this->belongsTo('App\User', 'fk_vendor');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'fk_product');
    }
}
