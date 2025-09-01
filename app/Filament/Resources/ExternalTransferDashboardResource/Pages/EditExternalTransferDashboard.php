<?php

namespace App\Filament\Resources\ExternalTransferDashboardResource\Pages;

use App\Filament\Resources\ExternalTransferDashboardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExternalTransferDashboard extends EditRecord
{
    protected static string $resource = ExternalTransferDashboardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
