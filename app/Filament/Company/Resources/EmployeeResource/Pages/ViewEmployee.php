<?php
namespace App\Filament\Company\Resources\EmployeeResource\Pages;

use App\Filament\Company\Resources\EmployeeResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;


class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['user'] = [
            'name' => $this->record->user->name,
            'email' => $this->record->user->email,
            'roles' => $this->record->user->roles->pluck('name')->toArray(),
        ];

        return $data;
    }
}
