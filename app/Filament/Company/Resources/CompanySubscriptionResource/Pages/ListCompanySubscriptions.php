<?php

namespace App\Filament\Company\Resources\CompanySubscriptionResource\Pages;

use App\Filament\Company\Resources\CompanySubscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanySubscriptions extends ListRecords
{
    protected static string $resource = CompanySubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
