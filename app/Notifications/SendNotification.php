<?php

namespace App\Notifications;

use Filament\Actions\Action;
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
    private $type;

    /**
     * Create a new notification instance.
     */
    public function __construct($obj_id, $title, $body, $type)
    {
        $this->obj_id = $obj_id;
        $this->title = $title;
        $this->body = $body;
        $this->type = $type;
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
            ->data(['obj_id' => (string)$this->obj_id, 'type' => $this->type])
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
            ->viewData(['obj_id' => $this->obj_id, 'type' => $this->type])
            ->getDatabaseMessage();
    }
}
