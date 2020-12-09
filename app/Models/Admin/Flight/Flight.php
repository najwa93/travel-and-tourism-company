<?php

namespace App\Models\Admin\Flight;

use App\Models\Admin\City\City;
use App\Models\Admin\Offer\Offer;
use App\Models\User\FlightReservation\FlightReservation;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function flight_company(){
        return $this->belongsTo(FlightCompany::class,'flight_company_id');
    }

    public function source_city(){
        return $this->belongsTo(City::class,'source_city_id');
    }

    public function destination_city(){
        return $this->belongsTo(City::class,'destination_city_id');
    }

    public function offer(){
        return $this->hasMany(Offer::class);
    }

    public function flight_reservation(){
        return $this->hasMany(FlightReservation::class);
    }

}
