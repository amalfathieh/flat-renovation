<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\CompanySubscriptionResource\Pages;
use App\Filament\Company\Resources\CompanySubscriptionResource\RelationManagers;
use App\Models\CompanySubscription;
//use Carbon\Traits\Date;
use App\Models\SubscriptionPlan;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class CompanySubscriptionResource extends Resource
{
    protected static ?string $model = CompanySubscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('subscription_plan_id')
                    ->options(
                        SubscriptionPlan::where('is_active', true)
                            ->pluck('name', 'id')
                    )
                    ->preload()
                    ->required(),

                Forms\Components\DatePicker::make('start_date')
                    ->default(now())
//                    ->disabled()
                ,
//                Forms\Components\Placeholder::make('start_date')
//                    ->default(now())
//                    ->disabled(),
//                Forms\Components\Placeholder::make('end_date')
//                    ->content(function ($get){
//                        return $get('start_date');
//                    }),
                Forms\Components\DatePicker::make('end_date')
//                    ->default(),
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->default('active')
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
                Tables\Columns\TextColumn::make('status'),
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
            'index' => Pages\ListCompanySubscriptions::route('/'),
            'create' => Pages\CreateCompanySubscription::route('/create'),
            'edit' => Pages\EditCompanySubscription::route('/{record}/edit'),
        ];
    }

}
