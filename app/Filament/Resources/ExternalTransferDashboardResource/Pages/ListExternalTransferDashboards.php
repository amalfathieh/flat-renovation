<?php

namespace App\Filament\Resources\ExternalTransferDashboardResource\Pages;

use App\Filament\Resources\ExternalTransferDashboardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExternalTransferDashboards extends ListRecords
{
    protected static string $resource = ExternalTransferDashboardResource::class;

    protected function getHeaderActions(): array
    {
        return [
           // Actions\CreateAction::make(),
        ];
    }
}
