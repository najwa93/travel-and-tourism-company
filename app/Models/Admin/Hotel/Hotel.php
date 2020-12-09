<?php

namespace App\Models\Admin\Hotel;

use App\Models\Admin\City\City;
use App\Models\Admin\Country\Country;
use App\Models\Admin\Offer\Offer;
use App\Models\User\HotelReservation\HotelReservation;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{

    protected $fillable = ['name','stars','country_id','city_id','phone_number','email','details','location'];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function hotelImage(){
        return $this->hasMany(HotelImage::class);
    }

    public function hotel_room(){
        return $this->hasMany(HotelRoom::class);
    }

    public function offer(){
        return $this->hasOne(Offer::class);
    }

    public function hotelReservation(){
        return $this->hasMany(HotelReservation::class);
    }
}
