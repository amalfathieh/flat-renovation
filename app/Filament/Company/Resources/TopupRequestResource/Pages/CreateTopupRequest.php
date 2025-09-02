<?php

namespace App\Filament\Company\Resources\TopupRequestResource\Pages;

use App\Filament\Company\Resources\TopupRequestResource;
use App\Models\User;
use App\Notifications\SendNotification;
use Filament\Resources\Pages\CreateRecord;

class CreateTopupRequest extends CreateRecord
{
    protected static string $resource = TopupRequestResource::class;

    protected function afterCreate(){
        $top = $this->record;
        $admin  = User::role('admin')->first();

        $admin->notify(new SendNotification($top->id,'New Top Up Request', "**New Top {$top->amount} created!**", "TopUp"));
    }

}
