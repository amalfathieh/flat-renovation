<?php

namespace App\Filament\Resources\TopUpRequestResource\Pages;

use App\Filament\Resources\TopUpRequestResource;
use App\Services\TopUpService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopUpRequest extends EditRecord
{
    protected static string $resource = TopUpRequestResource::class;

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

        return $data;
    }

}
