<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrders extends Model
{
    protected $table = 'purchase_orders';

    public function lines()
    {
        return $this->hasMany('App\PurchaseOrderDet', 'fk_po');
    }

    public function getStatus()
    {
        return $this->belongsTo('App\Status', 'status', 'code');
    }

    public function customer()
    {
        return $this->belongsTo("App\User", 'fk_customer');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function getFullAddressAttribute()
    {
        return "{$this->adresse_line_1} {$this->adresse_line_2}";
    }

    public function shipments()
    {
        return $this->hasMany("App\Shipment", "fk_po");
    }
}
