<?php

namespace App\Filament\Company\Resources\ExternalTransferResource\Pages;

use App\Filament\Company\Resources\ExternalTransferResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExternalTransfers extends ListRecords
{
    protected static string $resource = ExternalTransferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
