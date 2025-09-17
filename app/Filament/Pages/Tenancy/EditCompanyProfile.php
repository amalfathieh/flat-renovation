<?php
namespace App\Filament\Pages\Tenancy;

use App\Models\Company;
use Filament\Forms\Components\TextInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditCompanyProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Company profile';
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
                    })
                ->disabled(Auth::user()->cannot('company_edit')),

                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->unique(Company::class, 'slug', ignoreRecord: true),

                TextInput::make('location')
                    ->disabled(Auth::user()->cannot('company_edit')),

                TextInput::make('company.user.balance')
                    ->disabled(Auth::user()->cannot('company_edit')),

                TextInput::make('about')
                    ->disabled(Auth::user()->cannot('company_edit')),

                Forms\Components\FileUpload::make('logo')
                    ->getUploadedFileNameForStorageUsing(function ( $file, $record){
                        if($record && $record->image){
                            Storage::disk('public')->delete($record->image);
                        }
                        return $file->getClientOriginalname();
                    })
                    ->label('Logo')
                    ->disk('public')
                    ->directory('companies-logo')
                    ->image()
                    ->imageEditor()
                    ->nullable()
                    ->disabled(Auth::user()->cannot('company_edit')),
            ]);

    }
}
