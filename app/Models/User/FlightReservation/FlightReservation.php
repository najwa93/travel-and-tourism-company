<?php

namespace App\Models\User\FlightReservation;

use App\Models\Admin\Flight\Flight;
use App\Models\Admin\Flight\FlightDegree;
use App\User;
use Illuminate\Database\Eloquent\Model;

class FlightReservation extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function flight(){
        return $this->belongsTo(Flight::class,'flight_id');
    }

    public function flight_degree(){
        return $this->belongsTo(FlightDegree::class);
    }

}
