<?php

namespace App\Filament\Company\Resources\EmployeeResource\Pages;

use Filament\Notifications\Notification as FilamentNotification;
use App\Notifications\EmployeeInvitationNotification;
use Illuminate\Support\Str;
use App\Filament\Company\Resources\EmployeeResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $tempPassword = Str::random(10);

        $user = User::create([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'password' => bcrypt($tempPassword),
            'email_verified_at' => now(),
        ]);

        $roles = array_merge($data['user']['roles'] ?? [], ['employee']);
        $user->syncRoles(array_unique($roles));

        // إرسال الإشعار مع كلمة المرور المؤقتة
        $user->notify(new EmployeeInvitationNotification($tempPassword));

        $data['user_id'] = $user->id;
        unset($data['user']);

        return $data;
    }

    protected function getCreatedNotification(): ?FilamentNotification
    {
        return FilamentNotification::make()
            ->title('تم إنشاء الموظف بنجاح')
            ->body('تم إرسال بريد الدعوة إلى الموظف الجديد')
            ->success()
            ->send();
    }

}
