<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['conversation_id','sender_id', 'message','sender_type','sender_name','sender_image'];



    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
