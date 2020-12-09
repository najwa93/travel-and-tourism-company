<?php

namespace App\Models\City;

use Illuminate\Database\Eloquent\Model;

class CityLocation extends Model
{
    protected $fillable = [
        'name',
        'address_address',
        'address_latitude',
        'address_longitude',
    ];
}
