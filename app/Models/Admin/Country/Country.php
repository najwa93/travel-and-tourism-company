<?php

namespace App\Models\Admin\Country;

use App\Models\Admin\Hotel\Hotel;
use App\Models\Admin\City\City;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    public function user(){
        return $this->hasMany(User::class);
    }

    public function city(){
        return $this->hasMany(City::class);
    }

    public function hotel(){
        return $this->hasMany(Hotel::class);
    }


}
