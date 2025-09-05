<?php

namespace App\Filament\Widgets;

use App\Filament\Company\Resources\TopupRequestResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestTopUpRequest extends BaseWidget
{

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';


    public function table(Table $table): Table
    {
        return $table
            ->query(TopupRequestResource::getEloquentQuery()->where('status', 'pending'))
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('requester_type')
                    ->label('نوع الطالب')
                    ->formatStateUsing(fn ($state) => class_basename($state)),

                Tables\Columns\TextColumn::make('requester')
                    ->getStateUsing(
                        fn($record) =>
                            optional($record->requester)->name ??
                            optional(optional($record->requester)->user)->name ??
                            'Unknown'
                    )
                    ->label('الاسم'),

                Tables\Columns\TextColumn::make('amount')
                    ->money('SYP', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('paymentMethod.name')
                    ->label('Method')
                    ->label('طريقة التحويل'),

                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->label('Requested')
                    ->label('طلبت'),
            ]);
    }
}
