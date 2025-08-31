<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
//    use InteractsWithSockets, SerializesModels;
//
//    public $message;
//
//    public function __construct(Message $message)
//    {
//        // تحميل بيانات الـ sender بشكل آمن
//        $this->message = $message->loadMissing('sender');
//    }
//
//    public function broadcastOn()
//    {
//        return new PrivateChannel('chat.' . $this->message->conversation_id);
//    }
//
//    public function broadcastWith()
//    {
//        return [
//            'id' => $this->message->id,
//            'conversation_id' => $this->message->conversation_id,
//            'message' => $this->message->message,
//            'sender' => [
//                'id' => $this->message->sender->id ?? null,
//                'name' => $this->message->sender->full_name ?? $this->message->sender->email ?? null,
//                'type' => class_basename($this->message->sender_type),
//            ],
//            'created_at' => $this->message->created_at->toDateTimeString(),
//        ];
//    }
//}
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $senderName;
    public $senderType;
    public $senderId;
    public $receiverId; // تأكد من إضافة الخصائص المطلوبة

    public function __construct($message, $senderName, $senderType, $senderId, $receiverId,$senderImage)
    {
        $this->message = $message;
        $this->senderName = $senderName;
        $this->senderType = $senderType;
        $this->senderId = $senderId; // تعيين القيم للخصائص
        $this->receiverId = $receiverId; // تعيين القيم للخصائص
        $this->senderImage=$senderImage;
    }

    public function broadcastOn(): array
    {
        $channelName = 'conversation.' . min($this->senderId, $this->receiverId) . '.' . max($this->senderId, $this->receiverId);
        return [new Channel($channelName)];
    }

    public function broadcastAs()
    {
        return 'Message';
    }
}

