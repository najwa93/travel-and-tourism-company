<?php

namespace App\Models\User\HotelReservation;

use App\Models\Admin\Hotel\Hotel;
use App\Models\Admin\Hotel\HotelRoom;
use App\Models\Admin\Offer\Offer;
use App\User;
use Illuminate\Database\Eloquent\Model;

class HotelReservation extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function room(){
        return $this->belongsTo(HotelRoom::class);
    }
}
