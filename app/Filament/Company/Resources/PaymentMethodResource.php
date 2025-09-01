<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\PaymentMethodResource\Pages;
use App\Filament\Company\Resources\PaymentMethodResource\RelationManagers;
use App\Models\PaymentMethod;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class PaymentMethodResource extends Resource
{
    protected static ?string $model = PaymentMethod::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'طرق التحويل';
    protected static ?string $pluralLabel = 'طرق التحويل';
    protected static ?string $modelLabel = 'طريقة التحويل';
    protected static ?string $navigationGroup = 'Payments';

    protected static bool $isScopedToTenant = false;

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('الاسم'),
                Tables\Columns\TextColumn::make('instructions')
                    ->label('التعليمات')
                    ->formatStateUsing(function ($state) {
                        if (blank($state)) {
                            return '-';
                        }

                        // تأكد أنو عم يعمل decode
                        $data = is_array($state) ? $state : json_decode($state, true);

                        if (!$data) {
                            return $state; // fallback يعرض النص نفسه
                        }

                        // رجّع البيانات بشكل مرتب
                        return collect($data)
                            ->map(fn($value, $key) => "$key: $value")
                            ->implode("\n"); // فصل بأسطر
                    })
                    ->wrap()
                    ->toggleable(),

            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // 👈 السماح فقط بالعرض
            ])
            ->bulkActions([])
            ->headerActions([]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('معلومات أساسية')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')->label('الاسم'),
                        Infolists\Components\IconEntry::make('is_active')->boolean()->label('الحالة'),
                    ]),

                Infolists\Components\Section::make('التعليمات')
                    ->schema([
                        Infolists\Components\KeyValueEntry::make('instructions')
                            ->label('تفاصيل التحويل')
                            ->keyLabel('العنوان')
                            ->valueLabel('التفاصيل'),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentMethods::route('/'),
            'view' => Pages\ViewPaymentMethod::route('/{record}'),
        ];
    }
}
