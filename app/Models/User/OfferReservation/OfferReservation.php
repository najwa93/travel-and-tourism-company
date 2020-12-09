<?php

namespace App\Models\User\OfferReservation;

use App\Models\Admin\Offer\Offer;
use App\Models\User\FlightReservation\FlightReservation;
use App\Models\User\HotelReservation\HotelReservation;
use App\User;
use Illuminate\Database\Eloquent\Model;

class OfferReservation extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

}
