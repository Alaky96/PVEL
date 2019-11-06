<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    public function lines()
    {
        return $this->hasMany('App\ShipmentDet', 'fk_shipment');
    }

    public function po()
    {
        return $this->belongsTo("App\PurchaseOrders", 'fk_po');
    }

    public function supplier()
    {
        return $this->belongsTo('App\User', 'fk_vendor');
    }

    public function getStatus()
    {
        return $this->belongsTo('App\Status', 'status', 'code');
    }

    public function getStatusesAttribute()
    {
        return Status::whereIn('code', ['H', 'PS', 'C', 'S'])->orderBy('code', 'asc')->get();
    }
}
