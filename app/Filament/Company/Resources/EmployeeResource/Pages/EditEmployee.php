<?php

namespace App\Filament\Company\Resources\EmployeeResource\Pages;

use App\Filament\Company\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
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
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // تحديث بيانات المستخدم
        $userData = [
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
        ];

        if (!empty($data['user']['password'])) {
            $userData['password'] = bcrypt($data['user']['password']);
        }

        $this->record->user->update($userData);

        if (isset($data['user']['roles'])) {
            $this->record->user->syncRoles($data['user']['roles']);
        }
        unset($data['user']);

        return $data;
    }
}
