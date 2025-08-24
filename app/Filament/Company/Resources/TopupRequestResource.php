<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\TopupRequestResource\Pages;
use App\Filament\Company\Resources\TopupRequestResource\RelationManagers;
use App\Models\TopupRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopupRequestResource extends Resource
{
    protected static ?string $model = TopupRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Payments';
    protected static ?string $navigationLabel = 'طلباتي للشحن';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')->required()->numeric(),

                Forms\Components\Select::make('payment_method_id')
                    ->relationship('paymentMethod', 'name')
                    ->required(),

                Forms\Components\FileUpload::make('receipt_image')
                    ->image()
                    ->directory('topups')
                    ->required(),

                Forms\Components\TextInput::make('invoice_number')
                    ->columnSpanFull()
                    ->helperText("ادخل رقم وصل التحويل (الفاتورة)")
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->money('SYP', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('paymentMethod.name')
                    ->label('Method')
                    ->label('طريقة التحويل'),

                Tables\Columns\ImageColumn::make('receipt_image')
                    ->label('Receipt')
                    ->label('الوصل')
                    ->circular(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    ])
                    ->label('الحالة'),

                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->label('Requested')
                    ->label('طلبت'),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
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
            'index' => Pages\ListTopupRequests::route('/'),
            'create' => Pages\CreateTopupRequest::route('/create'),
            'edit' => Pages\EditTopupRequest::route('/{record}/edit'),
        ];
    }
}
