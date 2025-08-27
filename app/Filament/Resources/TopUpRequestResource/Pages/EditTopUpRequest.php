<?php

namespace App\Filament\Resources\TopUpRequestResource\Pages;

use App\Filament\Resources\TopUpRequestResource;
use App\Models\Company;
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
        $top = $this->record;

        $company  = Company::find($top->requester_id);
        $user = $company->user;

        if ($originalStatus !== 'approved' && $newStatus === 'approved') {
            // تنفيذ التحويل
            (new TopUpService())->approveTopUp($this->record);

            // منع حفظ الحالة مرتين (لأنها تغيرت بالخدمة)
            unset($data['status']);
        }
        // ✅ إذا تغيّر من أي حالة إلى مرفوض
        if ($originalStatus !== 'rejected' && $newStatus === 'rejected') {
            (new TopUpService())->rejectTopUp($this->record);

        }

        return $data;
    }

}
