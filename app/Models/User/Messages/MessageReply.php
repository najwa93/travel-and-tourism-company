<?php

namespace App\Models\User\Messages;

use Illuminate\Database\Eloquent\Model;

class MessageReply extends Model
{
    public function message(){
        return $this->belongsTo(Message::class);
    }
}
