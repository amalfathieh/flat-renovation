<?php

namespace App\Filament\Company\Resources\ObjectionResource\Pages;

use App\Filament\Company\Resources\ObjectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjections extends ListRecords
{
    protected static string $resource = ObjectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public static function canCreate(): bool
    {
        return false;
    }

}
