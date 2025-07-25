<?php

namespace App\Filament\Company\Resources\ProjectStageResource\Pages;

use App\Filament\Company\Resources\ProjectStageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectStages extends ListRecords
{
    protected static string $resource = ProjectStageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
