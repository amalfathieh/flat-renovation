<?php

namespace App\Filament\Company\Resources\TransactionsAllResource\Pages;

use App\Filament\Company\Resources\TransactionsAllResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionsAlls extends ListRecords
{
    protected static string $resource = TransactionsAllResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
