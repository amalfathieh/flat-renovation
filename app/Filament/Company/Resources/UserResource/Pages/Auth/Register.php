<?php

namespace App\Filament\Company\Resources\UserResource\Pages\Auth;

use App\Filament\Company\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;

class Register extends BaseRegister
{
    protected function handleRegistration(array $data): Model
    {
        $user = User::create([
           'name'=> $data['name'],
           'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone_number'=> $data['phone_number']?? null,
        ]);
        $user->assignRole('company');
        return $user;
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                         TextInput::make('phone_number')
                            ->label('Mobile Number')
                            ->tel() // نوع الحقل رقم هاتف
                            ->required()
                            ->maxLength(255),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

}
