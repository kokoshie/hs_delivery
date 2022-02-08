<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $fillable = ['name'];

    public function wayplan() {
        return $this->belongsTo('App\WayPlanSchedule');
    }

}
