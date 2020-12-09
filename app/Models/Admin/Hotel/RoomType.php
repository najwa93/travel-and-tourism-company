<?php

namespace App\Models\Admin\Hotel;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    public function hotel_room(){
        return $this->hasMany(HotelRoom::class);
    }
}
