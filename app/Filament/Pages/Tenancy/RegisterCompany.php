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
        return __('strings.company.register_company');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('strings.company.name'))
                    ->required()
                    ->live(onBlur: true)
                    ->unique(Company::class, 'name', ignoreRecord:true)

                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set){

                                $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->label(__('strings.company.slug'))
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->unique(Company::class, 'slug', ignoreRecord: true),

                TextInput::make('email')
                    ->label('البريد الإلكتروني الخاص بالشركة')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('location')
                    ->label(__('strings.company.location')),

                Forms\Components\Section::make(__('strings.more_info'))
                    ->schema([
                        Forms\Components\MarkdownEditor::make('about')
                            ->label(__('strings.company.about'))
                            ->columnSpan('full'),

                        Forms\Components\FileUpload::make('logo')
                            ->label(__('strings.company.logo'))
                            ->preserveFilenames()
                            ->directory('companies-logo')
                            ->image()
                            ->imageEditor()
                            ->nullable(),
                    ])->collapsible(),
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
