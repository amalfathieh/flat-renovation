<?php

namespace App\Filament\Resources\TopUpRequestResource\Pages;

use App\Filament\Resources\TopUpRequestResource;
use App\Http\Controllers\PushNotificationController;
use App\Services\TopUpService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class  EditTopUpRequest extends EditRecord
{
    protected static string $resource = TopUpRequestResource:: class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $originalStatus = $this->record->status;
        $newStatus = $data['status'] ?? $originalStatus;

        if ($originalStatus !== 'approved' && $newStatus === 'approved') {
            // تنفيذ التحويل
            (new TopUpService())->approveTopUp($this->record);

            // منع حفظ الحالة مرتين (لأنها تغيرت بالخدمة)
            unset($data['status']);
        }


        // ✅ إذا تغيّر من أي حالة إلى مرفوض
        if ($originalStatus !== 'rejected' && $newStatus === 'rejected') {
            $user = $this->record->user; // بافتراض أن طلب الشحن مرتبط بمستخدم

            if ($user && $user->device_token) {
                $push = new PushNotificationController();
                $push->sendPushNotification(
                    'طلب الشحن مرفوض ❌',
                    'معلومات الدفع غير صحيحة، لم يتم شحن رصيدك في التطبيق. يرجى المحاولة مرة أخرى.',
                    $user->device_token
                );
            }
        }


        return $data;
    }

}
