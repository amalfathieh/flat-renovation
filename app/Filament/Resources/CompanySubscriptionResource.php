<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanySubscriptionResource\Pages;
use App\Filament\Resources\CompanySubscriptionResource\RelationManagers;
use App\Models\CompanySubscription;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanySubscriptionResource extends Resource
{
    protected static ?string $model = CompanySubscription::class;

    protected static ?string $modelLabel = 'الاشتراك';
    protected static ?string $pluralModelLabel = 'اشتراك الشركات';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_id')
                    ->required()
                    ->numeric(),
                Select::make('subscription_plan_id')
                    ->relationship('subscriptionPlan', 'name')
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('used_projects')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subscriptionPlan.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'info' => 'cancelled',
                        'success' => 'active',
                        'danger' => 'expired',
                    ]),
                Tables\Columns\TextColumn::make('used_projects')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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
                    ])->columns(2),

                Section::make('الاشتراك')
                    ->schema([
                        TextEntry::make('id')->label('معرف الاشتراك'),
                        TextEntry::make('created_at')
                            ->label('تاريخ إنشاء الاشتراك')
                            ->date(),
                        TextEntry::make('company.id')->label('معرف الشركة'),
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

                        TextEntry::make('المتبقي')->getStateUsing(function ($record){
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
