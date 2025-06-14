<?php

namespace App\Filament\Company\Resources\ServiceTypeResource\Pages;

use App\Filament\Company\Resources\ServiceTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceType extends EditRecord
{
    protected static string $resource = ServiceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
