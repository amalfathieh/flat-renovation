<?php

namespace App\Filament\Company\Resources\ProjectResource\Pages;

use App\Events\ProjectCreated;
use App\Filament\Company\Resources\ProjectResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\HttpKernel\Log\record;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $record = parent::handleRecordCreation($data);

        event(new ProjectCreated($record));

        return $record;

    }

}
