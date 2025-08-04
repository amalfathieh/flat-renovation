<?php

namespace App\Filament\Company\Resources\TopupRequestResource\Pages;

use App\Filament\Company\Resources\TopupRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopupRequests extends ListRecords
{
    protected static string $resource = TopupRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
