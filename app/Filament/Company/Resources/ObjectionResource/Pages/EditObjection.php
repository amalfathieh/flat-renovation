<?php

namespace App\Filament\Company\Resources\ObjectionResource\Pages;

use App\Filament\Company\Resources\ObjectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjection extends EditRecord
{
    protected static string $resource = ObjectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
