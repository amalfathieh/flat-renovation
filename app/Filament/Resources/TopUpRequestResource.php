<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopUpRequestResource\Pages;
use App\Filament\Resources\TopUpRequestResource\RelationManagers;
use App\Models\TopUpRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopUpRequestResource extends Resource
{
//    protected static ?string $navigationLabel = 'Top-Up Requests';
    protected static ?string $navigationGroup = 'Payments';
    protected static ?string $model = TopUpRequest::class;


    protected static ?string $modelLabel = 'طلب الشحن';
    protected static ?string $pluralModelLabel = 'طلبات الشحن';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->helperText('عند تغير حالة الطلب الى Approved سيتم اضافة رصيد لمحفظة صاحب الطلب وتسجيل معاملة بالعملية')
                    ->required(),

                Forms\Components\Textarea::make('admin_note')
                    ->label('Admin Note')
                    ->rows(3),

                Forms\Components\TextInput::make('amount')
                    ->disabled(),

                Forms\Components\Select::make('payment_method_id')
                    ->relationship('paymentMethod', 'name')
                    ->disabled(),

                Forms\Components\FileUpload::make('receipt_image')
                    ->image()->directory('topups')
                    ->disabled(),

                Forms\Components\TextInput::make('invoice_number')
                    ->label('Invoice Number')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('requester_type')
//                    ->label('Requester Type')
                    ->label('نوع الطالب')
                    ->formatStateUsing(fn ($state) => class_basename($state)),
                Tables\Columns\TextColumn::make('requester.name')
                    ->label('Name')
                    ->label('الاسم'),

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
            'index' => Pages\ListTopUpRequests::route('/'),
//            'create' => Pages\CreateTopUpRequest::route('/create'),
            'edit' => Pages\EditTopUpRequest::route('/{record}/edit'),
        ];
    }
}
