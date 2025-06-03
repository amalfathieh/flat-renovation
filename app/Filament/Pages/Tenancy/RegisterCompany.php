<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Company;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Support\Str;

use Filament\Forms;

class RegisterCompany extends RegisterTenant
{

    public static function getLabel(): string
    {
        return 'Register company';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->unique(Company::class, 'name', ignoreRecord:true)

                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set){
                                if ($operation !== 'create'){
                                    return ;
                                }
                                $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
//                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->unique(Company::class, 'slug', ignoreRecord: true),

                TextInput::make('location'),
                TextInput::make('about'),

                Forms\Components\FileUpload::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->directory('companies-logo')
                    ->image()
                    ->imageEditor()
                    ->nullable(),
            ]);
    }
    protected function handleRegistration(array $data): Company
    {
        $company = new Company($data);
        $company->owner()->associate(auth()->user());
        $company->save();
        return $company;
    }


    public static function shouldRegisterNavigation()
    {
        return auth()->user() && auth()->user()->company === null;
    }

    public function canAccess()
    {
        return auth()->user()?->company === null;
    }
}
