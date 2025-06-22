<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class EmployeeInvitationNotification extends Notification
{
    use Queueable;

    public string $temporaryPassword;
    /**
     * Create a new notification instance.
     */
    public function __construct(string $temporaryPassword)
    {
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $loginUrl = URL::route('filament.company.auth.login');

        return (new MailMessage)
            ->subject('دعوة للانضمام إلى نظام إدارة الشركات')
            ->greeting('مرحباً ' . $notifiable->name . '!')
            ->line('لقد تمت دعوتك للانضمام إلى نظام إدارة الشركات كموظف.')
            ->line('بيانات الدخول الخاصة بك:')
            ->line('البريد الإلكتروني: ' . $notifiable->email)
            ->line('كلمة المرور المؤقتة: ' . $this->temporaryPassword)
            ->action('تسجيل الدخول', $loginUrl)
            ->line('ننصحك بتغيير كلمة المرور بعد أول تسجيل دخول.')
            ->salutation('مع تحيات، فريق الإدارة');

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
