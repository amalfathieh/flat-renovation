<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\RoleResource\Pages;
use App\Filament\Company\Resources\RoleResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationGroup = 'إدارة الوصول';
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $modelLabel = 'دور';
    protected static ?string $pluralModelLabel = 'الأدوار المتاحة';

    protected static bool $isScopedToTenant = false;


    public static function getEloquentQuery(): Builder
    {

        return Role::whereNotIn('name', ['admin', 'employee'])
            ->where('to_company', true);

    }

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
                Tables\Columns\TextColumn::make('name')->label('اسم الرول')
                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('permissions_count')->counts('permissions')->label('عدد الصلاحيات'),

                Tables\Columns\TextColumn::make('permissions.name')
                    ->label('الصلاحيات')
                    ->badge()
                    ->color(function ($state) {
                        $colors = ['primary', 'success', 'info', 'gray', 'danger', 'warning',];
                        $index = crc32($state) % count($colors);
                        return $colors[$index];
                    }),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
