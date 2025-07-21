<?php

namespace App\Filament\Company\Resources\ProjectResource\Pages;

use App\Filament\Company\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
