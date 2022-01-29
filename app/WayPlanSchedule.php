<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WayPlanSchedule extends Model
{
    //
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'receive_point',
        'receive_address',
        'receive_date',
        'dropoff_point',
        'dropoff_address',
        'dropoff_date',
        'tracking_id',
        'remark',
        'parcel_quantity',
        'total_weight',
        'per_kg_charges',
        'package_id',
        'total_charges',
        'receive_status',
        'dropoff_status',
        'rider_id',
        'customer_address',
        'customer_status',
        'myawady_status',
        'myawady_date',
        'customer_date',
        'token',
        'way_status',
        'receive_remark',
        'dropoff_remark',
        'myawady_remark',
        'customer_remark',
        'reject_status',
        'reject_date',
        'register_date',
            ];
            public function receivelocation() {
                return $this->belongsTo('App\Location','receive_point');
            }
            public function dropofflocation() {
                return $this->belongsTo('App\Location','dropoff_point');
            }
}
