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
        'way_status',
        'rider_id',
        'token',
        'myawady_status',
        'customer_status',
        'customer_date',
        'myawady_date',
        'customer_address',
            ];
}
