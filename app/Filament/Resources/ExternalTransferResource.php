<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExternalTransferResource\Pages;
use App\Models\ExternalTransfer;
use App\Models\Company;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ExternalTransferResource extends Resource
{
    protected static ?string $model = ExternalTransfer::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-uturn-left';

    protected static ?string $navigationLabel = 'التحويلات الخارجية';
    protected static ?string $navigationGroup = 'الإدارة المالية';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('admin_id')
                    ->label('الإدمن')
                    ->relationship('admin', 'name') // بافتراض عندك علاقة admin() ترجع User
                    ->required(),

                Forms\Components\Select::make('company_id')
                    ->label('الشركة')
                    ->relationship('company', 'name') // بافتراض عندك علاقة company() ترجع Company
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('المبلغ')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('invoice_number')
                    ->label('رقم الفاتورة'),

                Forms\Components\FileUpload::make('receipt_image')
                    ->label('صورة الوصل')
                    ->image()
                    ->directory('receipts')
                    ->downloadable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),

                TextColumn::make('admin.name')
                    ->label('الإدمن')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('company.name')
                    ->label('الشركة')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('amount')
                    ->label('المبلغ')
                    ->money('USD', true) // أو العملة اللي تستعملها
                    ->sortable(),

                TextColumn::make('invoice_number')
                    ->label('رقم الفاتورة'),

                ImageColumn::make('receipt_image')
                    ->label('صورة الوصل'),

                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime('Y-m-d H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExternalTransfers::route('/'),
            'create' => Pages\CreateExternalTransfer::route('/create'),
            'edit' => Pages\EditExternalTransfer::route('/{record}/edit'),
        ];
    }
}
