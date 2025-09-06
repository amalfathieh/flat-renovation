<?php

namespace App\Filament\Company\Resources\UserResource\Pages\Auth;

use App\Filament\Company\Resources\UserResource;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Register extends BaseRegister
{
    protected function handleRegistration(array $data): Model
    {
        $user = User::create([
           'name'=> $data['name'],
           'email' => $data['email'],
            'password' => Hash::make('password'),
//            'password' => bcrypt($data['password']),
            'phone'=> $data['phone']?? null,
        ]);
        $user->assignRole('company');
        event(new Registered($user));
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
                         TextInput::make('phone')
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
