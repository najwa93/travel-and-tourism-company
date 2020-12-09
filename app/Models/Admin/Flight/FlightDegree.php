<?php

namespace App\Models\Admin\Flight;

use App\Models\Admin\Offer\Offer;
use App\Models\User\FlightReservation\FlightReservation;
use Illuminate\Database\Eloquent\Model;

class FlightDegree extends Model
{
    public function offer(){
        return $this->hasMany(Offer::class);
}

    public function flight_reservation(){
        return $this->hasMany(FlightReservation::class);
    }

}
