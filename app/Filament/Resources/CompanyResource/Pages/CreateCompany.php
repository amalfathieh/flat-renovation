<?php

namespace App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Stripe\Account;
use Stripe\Stripe;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;


}
