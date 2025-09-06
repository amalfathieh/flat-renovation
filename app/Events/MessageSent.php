<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel; // ملاحظة: الآن عام
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $senderName;
    public $senderType;
    public $senderId;
    public $receiverId;
    public $senderImage;

    public function __construct($message, $senderName, $senderType, $senderId, $receiverId, $senderImage)
    {
        $this->message     = $message;
        $this->senderName  = $senderName;
        $this->senderType  = $senderType;
        $this->senderId    = $senderId;
        $this->receiverId  = $receiverId;
        $this->senderImage = $senderImage;
    }

    // هنا غيّرنا PrivateChannel إلى Channel
    public function broadcastOn(): array
    {
        $channelName = 'conversation.' . min($this->senderId, $this->receiverId) . '.' . max($this->senderId, $this->receiverId);
        return [new Channel($channelName)];
    }

    public function broadcastAs()
    {
        return 'Message';
    }

    public function broadcastWith()
    {
        return [
            'message'     => $this->message,
            'sender_id'   => $this->senderId,
            'sender_name' => $this->senderName,
            'sender_type' => $this->senderType,
            'sender_image'=> $this->senderImage,
            'receiver_id' => $this->receiverId,
        ];
    }
}
