<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StoreNotification extends Notification
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
        $this->type  = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray( $notifiable): array
    {
        return [
            'obj_id' => $this->obj_id,
            'title'=>$this->title,
            'body' => $this->body,
            'type' => $this->type,
        ];
    }

}
