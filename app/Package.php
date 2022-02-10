<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    protected $fillable = [
        'package_name',
        'from_city_id',
        'to_city_id',
        'from_city_name',
        'to_city_name',
    ];
}

