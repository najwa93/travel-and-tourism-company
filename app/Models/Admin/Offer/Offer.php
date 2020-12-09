<?php

namespace App\Models\Admin\Offer;

use App\Models\Admin\Flight\Flight;
use App\Models\Admin\Flight\FlightDegree;
use App\Models\Admin\Hotel\Hotel;
use App\Models\Admin\Hotel\HotelRoom;
use App\Models\User\FlightReservation\FlightReservation;
use App\Models\User\HotelReservation\HotelReservation;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

     public $timestamps = false;
    public function flight(){
        return $this->belongsTo(Flight::class,'flight_id');
    }

    public function returned_flight(){
        return $this->belongsTo(Flight::class,'returned_flight_id');
    }

//    public function hotel(){
//        return $this->belongsTo(Hotel::class);
//    }

    public function room(){
        return $this->hasMany(HotelRoom::class);
    }
    public function flight_degree(){
        return $this->belongsTo(FlightDegree::class);
    }

    public function flight_reservation(){
        return $this->hasMany(FlightReservation::class);
    }

    public function hotel_reservation(){
        return $this->hasMany(HotelReservation::class);
    }
/*
    public function source_country(){
        return $this->belongsTo(Country::class,'source_country_id');
    }

    
    }*/

}
