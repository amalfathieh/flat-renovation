<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\ExternalTransferResource\Pages;
use App\Filament\Company\Resources\ExternalTransferResource\RelationManagers;
use App\Models\ExternalTransfer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExternalTransferResource extends Resource
{
    protected static ?string $model = ExternalTransfer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralModelLabel = 'التحويلات الخارجية من الادمن ';
    protected static ?string $navigationGroup = 'Payments';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('admin.name')
                    ->label('الإدمن')
                    ->sortable(),

                TextColumn::make('amount')
                    ->label('المبلغ')
                    ->money('USD', true)
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
               // Tables\Actions\EditAction::make(),
               // Tables\Actions\ViewAction::make(), // ✅ زر عرض فقط
            ])
            ->bulkActions([
              //  Tables\Actions\BulkActionGroup::make([
                  //  Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListExternalTransfers::route('/'),
           // 'create' => Pages\CreateExternalTransfer::route('/create'),
           // 'edit' => Pages\EditExternalTransfer::route('/{record}/edit'),

        ];
    }






}
