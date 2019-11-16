<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentDet extends Model
{
    protected $table = 'shipments_dets';

    public function product()
    {
        return $this->belongsTo("App\Product", 'fk_product')->withTrashed();
    }
}
