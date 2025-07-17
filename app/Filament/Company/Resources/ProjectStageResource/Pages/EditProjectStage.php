<?php

namespace App\Filament\Company\Resources\ProjectStageResource\Pages;

use App\Filament\Company\Resources\ProjectStageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectStage extends EditRecord
{
    protected static string $resource = ProjectStageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
