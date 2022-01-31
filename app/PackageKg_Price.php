<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageKg_Price extends Model
{
    //
    protected $fillable = [
        'package_id',
        'min_kg',
        'max_kg',
        'per_kg_price',
        'currency',
    ];
}
