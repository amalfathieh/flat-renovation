<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\ServiceTypeResource\Pages;
use App\Filament\Company\Resources\ServiceTypeResource\RelationManagers;
use App\Models\ServiceType;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ServiceTypeResource extends Resource
{
    protected static ?string $model = ServiceType::class;

    protected static ?string $pluralModelLabel = 'انواع الخدمات';
    protected static ?string $modelLabel = 'نوع خدمة';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static ?string $tenantOwnershipRelationshipName = 'service';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'name', modifyQueryUsing: function ($query) {
                        if (Auth::user()->hasRole('employee')) {
                            $query->where('company_id',  auth()->user()->employee->company_id);
                        }
                        if (Auth::user()->hasRole('company')) {
                            $query->where('company_id',  Auth::user()->company->id);
                        }
                    })
                    ->required(),

                TextInput::make('name')
                    ->required()
                    ->label('اسم النوع')
                    ->maxLength(255),

                Textarea::make('description')
                    ->required()
                    ->label('وصف النوع')
                    ->columnSpanFull(),

                TextInput::make('unit')
                    ->required()
                    ->label('الوحدة(م2 ، قطعة،..')
                    ->maxLength(255),

                TextInput::make('price_per_unit')
                    ->required()
                    ->label('السعر للوحدة')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service.name')
                    ->label('التصنيق')
                    ->sortable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('اسم النوع')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit')
                    ->label('الوحدة(م2 ، قطعة،..)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_per_unit')
                    ->label('السعر للوحدة')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceTypes::route('/'),
            'create' => Pages\CreateServiceType::route('/create'),
            'edit' => Pages\EditServiceType::route('/{record}/edit'),
        ];
    }
}
