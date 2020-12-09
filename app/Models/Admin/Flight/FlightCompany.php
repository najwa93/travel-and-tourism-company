<?php

namespace App\Models\Admin\Flight;

use Illuminate\Database\Eloquent\Model;

class FlightCompany extends Model
{
    public function flight(){
        return $this->hasMany(Flight::class);
    }
}
