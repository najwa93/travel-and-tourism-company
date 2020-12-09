<?php

namespace App\Models\User\Messages;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function message_reply(){
        return $this->hasMany(MessageReply::class);
    }
}
