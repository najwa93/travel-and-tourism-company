<?php

namespace App\Models\Admin\Hotel;

use Illuminate\Database\Eloquent\Model;

class HotelImage extends Model
{
    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }
}
