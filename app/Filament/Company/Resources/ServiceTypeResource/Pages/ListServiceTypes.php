<?php

namespace App\Filament\Company\Resources\ServiceTypeResource\Pages;

use App\Filament\Company\Resources\ServiceTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceTypes extends ListRecords
{
    protected static string $resource = ServiceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
