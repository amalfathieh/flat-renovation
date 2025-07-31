<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $modelLabel = 'شركة';
    protected static ?string $pluralModelLabel = 'الشركات';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Textarea::make('about')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('logo')
                    ->maxLength(255),



            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('logo')->label('الشعار'),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('اسم الشركة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('رابط')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('الايميل')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('الموقع'),

                Tables\Columns\TextColumn::make('employees_count')
                    ->label('عدد الموظفين')
                    ->counts('employees'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->date(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            RelationManagers\EmployeesRelationManager::class,
        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                    Section::make('معلومات الشركة')
                        ->schema([
                            TextEntry::make('name')
                                ->label('اسم الشركة'),

                            TextEntry::make('location')
                                ->label('الموقع'),

                            TextEntry::make('about')
                                ->label('عن الشركة'),

                                    ImageEntry::make('logo')
                                        ->label('الشعار')
                                        ->disk('public')
                                        ->height(150),
                        ])->columns(2),

                    Section::make('المالك')
                        ->schema([
                            TextEntry::make('owner.name')
                                ->label('الاسم'),

                            TextEntry::make('owner.email')
                                ->label('البريد الإلكتروني'),

                        ])->columns(2)

            ]);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
           //'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
