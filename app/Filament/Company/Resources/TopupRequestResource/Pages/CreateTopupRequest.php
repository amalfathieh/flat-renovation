<?php

namespace App\Filament\Company\Resources\TopupRequestResource\Pages;

use App\Filament\Company\Resources\TopupRequestResource;
use App\Models\User;
use App\Notifications\SendNotification;
use Filament\Resources\Pages\CreateRecord;

class CreateTopupRequest extends CreateRecord
{
    protected static string $resource = TopupRequestResource::class;

    protected function afterCreate(){//**New Top {$top->amount} created!**
        $top = $this->record;
        $admin  = User::role('admin')->first();

        $admin->notify(new SendNotification($top->id,'طلب شحن محفظة', "لديك طلب شحن محفظة جديد بقيمة {$top->amount}!", "TopUp"));
    }

}
