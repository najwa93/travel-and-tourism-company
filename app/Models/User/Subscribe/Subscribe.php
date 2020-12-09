<?php

namespace App\Models\User\Subscribe;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
