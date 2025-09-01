<?php

namespace App\Filament\Resources\ExternalTransferResource\Pages;

use App\Filament\Resources\ExternalTransferResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExternalTransfer extends EditRecord
{
    protected static string $resource = ExternalTransferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
