<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\TransactionsAllResource\Pages;
use App\Filament\Company\Resources\TransactionsAllResource\RelationManagers;
use App\Models\TransactionsAll;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\TransactionSource;

class TransactionsAllResource extends Resource
{
    protected static ?string $model = TransactionsAll::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';


    protected static ?string $navigationGroup = 'Payments';
    protected static ?string $navigationLabel = 'معاملات المحفظة';

    public static function getEloquentQuery(): Builder
    {
        $company = Filament::getTenant(); // أو auth()->user()->company حسب السياق عندك

        return $company
            ? $company->allTransactions() // هاي هي العلاقة يلي بتعرض الدافعة أو المستلمة
            : static::getModel()::query()->whereNull('id'); // يرجّع لا شيء إذا ما في شركة
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number'),

                Tables\Columns\TextColumn::make('payer_name')->label('اسم الدافع')
                    ->getStateUsing(
                        fn($record) =>
                            optional($record->payer)->name ??
                            optional(optional($record->payer)->user)->name ??
                            'Unknown'
                    ),

                Tables\Columns\TextColumn::make('receiver_name')->label('اسم المستلم')
                    ->getStateUsing(
                        fn($record) =>
                            optional($record->receiver)->name ??
                            optional(optional($record->receiver)->user)->name ??
                            'Unknown'
                    ),

                Tables\Columns\TextColumn::make('source')
                    ->label('نوع العملية'),

                Tables\Columns\TextColumn::make('amount')
                    ->label('المبلغ')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('related_type')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('related_id')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('source')
                    ->options(TransactionSource::class),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('معلومات الأطراف')
                    ->schema([
                        TextEntry::make('payer_name')->label('اسم الدافع')
                            ->getStateUsing(
                                fn($record) =>
                                optional($record->payer)->name ??
                                optional(optional($record->payer)->user)->name ??
                                'Unknown'
                            ),
                        TextEntry::make('payer_id'),

                        TextEntry::make('receiver_name')->label('اسم المستلم')
                            ->getStateUsing(
                                fn($record) =>
                                    optional($record->receiver)->name ??
                                    optional(optional($record->receiver)->user)->name ??
                                    'Unknown'
                            ),
                        TextEntry::make('receiver_id'),

                    ])->columns(2),

                Section::make('تفاصيل المعاملة')
                    ->schema([
                        TextEntry::make('invoice_number')
                            ->numeric(),
                        TextEntry::make('amount')->label('المبلغ'),
                        TextEntry::make('source')->label('النوع'),
                        TextEntry::make('created_at')->label('تاريخ المعاملة'),
                        TextEntry::make('note'),

                    ])->columns(2),


                Section::make('المعاملة تابعة ل')
                    ->schema([
                        TextEntry::make('related_type'),
                        TextEntry::make('related_id'),
                        TextEntry::make('related.name'),
                    ])->columns(3),
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
            'index' => Pages\ListTransactionsAlls::route('/'),
            'create' => Pages\CreateTransactionsAll::route('/create'),
//            'view' => Pages\ViewTransactionsAll::route('/view'),
            'edit' => Pages\EditTransactionsAll::route('/{record}/edit'),
        ];
    }
}
