<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class SendNotification extends Notification
{
    use Queueable;
    private $obj_id;
    private $title;
    private $body;

    public function __construct($data)
    {
        $this->obj_id = $data['obj_id'];
        $this->title  = $data['title'];
        $this->body   = $data['body'];
    }

    public function via($notifiable)
    {
        return [FcmChannel::class, 'database'];
    }

    public function toFcm($notifiable): FcmMessage
    {
        return (new FcmMessage(notification: new FcmNotification(
            title: $this->title,
            body: $this->body,
            image: 'http://example.com/url-to-image-here.png'
        )))
            ->data(['obj_id' => (string)$this->obj_id])
            ->custom([
                'android' => [
                    'notification' => [
                        'sound' => 'default', // أو ملف صوتي مخصص موجود في res/raw
                    ],
                ],
                'apns' => [
                    'payload' => [
                        'aps' => [
                            'sound' => 'default', // أو اسم ملف صوتي مضاف لمشروع iOS
                        ],
                    ],
                ],
            ])
        ;
    }

    public function toDatabase()
    {
        return \Filament\Notifications\Notification::make()
            ->title($this->title)
            ->body($this->body)
            ->viewData(['obj_id' => $this->obj_id])
            ->getDatabaseMessage();
    }
}
