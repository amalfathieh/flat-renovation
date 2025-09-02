<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\CompanySubscriptionResource\Pages;
use App\Filament\Company\Resources\CompanySubscriptionResource\RelationManagers;
use App\Models\CompanySubscription;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompanySubscriptionResource extends Resource
{
    protected static ?string $model = CompanySubscription::class;
    protected static ?string $modelLabel = 'الاشتراك';
    protected static ?string $pluralModelLabel = 'اشتراكاتي';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subscriptionPlan.name')
                    ->label('اسم الباقة')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('تاريخ البداية')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('تاريخ النهاية')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->colors([
                        'info' => 'cancelled',
                        'success' => 'active',
                        'danger' => 'expired',
                    ]),
                Tables\Columns\TextColumn::make('used_projects')
                    ->label('عدد المشاريع المستهلكة')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الاشتراك')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('subscriptionPlan.duration_in_days')
                    ->label('مدة الباقة')
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('معلومات الباقة')
                    ->schema([
                        TextEntry::make('subscription_plan_id')->label('معرف الباقة'),
                        TextEntry::make('subscriptionPlan.name')->label('اسم الباقة'),
                        TextEntry::make('subscriptionPlan.duration_in_days')->label('مدة الباقة'),
                        TextEntry::make('subscriptionPlan.description')->label('وصف الباقة'),
                    ])->columns(3),

                Section::make('الاشتراك')
                    ->schema([
                        TextEntry::make('id')->label('معرف الاشتراك'),
                        TextEntry::make('created_at')
                            ->label('تاريخ إنشاء الاشتراك')
                            ->date(),
                        TextEntry::make('company.name')->label('اسم الشركة'),

                        TextEntry::make('start_date')
                            ->label('تاريخ البداية')
                            ->date(),
                        TextEntry::make('end_date')
                            ->label('تاريخ النهاية')
                            ->date(),
                    ])->columns(2),
                Section::make('')
                    ->schema([
                        TextEntry::make('subscriptionPlan.project_limit')->label('عدد المشاريع المتاحة بالباقة')
                            ->numeric(),

                        TextEntry::make('used_projects')->label('عدد المشاريع المستهلكة'),

                        TextEntry::make('المتبقي')->getStateUsing(function ($record) {
                            //                            dd($record->subscriptionPlan);
                            return $record->subscriptionPlan->project_limit - $record->used_projects;
                        }),
                        TextEntry::make('status')
                            ->label('الحالة')
                            ->badge()
                            ->colors([
                                'info' => 'cancelled',
                                'success' => 'active',
                                'danger' => 'expired',
                            ]),
                    ])->columns(4),
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
            'index' => Pages\ListCompanySubscriptions::route('/'),
            'create' => Pages\CreateCompanySubscription::route('/create'),
            'edit' => Pages\EditCompanySubscription::route('/{record}/edit'),
        ];
    }
}
