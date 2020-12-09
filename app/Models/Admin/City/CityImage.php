<?php

namespace App\Models\Admin\City;

use Illuminate\Database\Eloquent\Model;

class CityImage extends Model
{
    public function city(){
        return $this->hasMany(City::class);
    }
}
