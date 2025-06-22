<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $modelLabel = 'خدمة';
    protected static ?string $pluralModelLabel = 'الخدمات';
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([

                        TextInput::make('name')
                            ->label(__('strings.service_name'))
                            ->minLength(3)
                            ->required(),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\MarkdownEditor::make('description')
                                    ->label(__('strings.description')),

                                Forms\Components\FileUpload::make('image')
                                    ->label(__('strings.image'))
                                    ->directory('service-images')
                                    ->preserveFilenames()
                                    ->image()
                                    ->imageEditor(),

                            ])->columns(2),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                TextColumn::make('name')
                    ->label(__('strings.service_name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label(__('strings.description')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }

    //    public static function getNavigationLabel(): string
    //    {
    //        return __('strings.navigation.services');
    //    }
}
