<?php

namespace App\Filament\Company\Resources\TopupRequestResource\Pages;

use App\Filament\Company\Resources\TopupRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTopupRequest extends CreateRecord
{
    protected static string $resource = TopupRequestResource::class;

//    protected function mutateFormDataBeforeCreate(array $data): array
//    {
//        $company = auth()->user()->company;
//
//        $data['requester_type'] = get_class($company);
//        $data['requester_id'] = $company->id;
//        $data['status'] = 'pending';
//
//        return $data;
//    }

}
