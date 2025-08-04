<?php

namespace App\Filament\Company\Resources\TopupRequestResource\Pages;

use App\Filament\Company\Resources\TopupRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopupRequest extends EditRecord
{
    protected static string $resource = TopupRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
