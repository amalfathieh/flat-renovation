<?php

namespace App\Filament\Resources\ExternalTransferResource\Pages;

use App\Filament\Resources\ExternalTransferResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExternalTransfers extends ListRecords
{
    protected static string $resource = ExternalTransferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
