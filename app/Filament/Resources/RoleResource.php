<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationGroup = 'إدارة الوصول';
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $modelLabel = 'دور';
    protected static ?string $pluralModelLabel = 'الأدوار';
    protected static bool $isScopedToTenant = false;

    public static function getEloquentQuery(): Builder
    {

            return Role::whereNotIn('name', ['admin', 'employee']);

        return parent::getEloquentQuery();
    }
    public static function form(Form $form): Form
    {

        // جيب صلاحيات رول company_base_permissions
        $baseRole = Role::where('name', 'base_permissions')->first();
        $permissions = $baseRole?->permissions->pluck('name', 'id') ?? [];

        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('اسم الدور')
                ->required(),

            Forms\Components\Toggle::make('to_company')
                ->label('مرئية للشركة؟')
                ->helperText('عند تفعيل هذا الحقل سيتمكن الشركات من رؤية هذا الدور واستخدامه كدور لموظفيها')
                ->reactive(),

            /*Forms\Components\Select::make('permissions')
                ->label('الصلاحيات')
                ->options($permissions)
                ->multiple()
                ->preload()
                ->searchable()
                ->columnSpanFull()
                ->afterStateHydrated(function ($component, $state, $record) {
                    if ($record) {
                        $component->state($record->permissions->pluck('id')->toArray());
                    }
                })
                ->dehydrateStateUsing(fn ($state) => array_values($state))
                ->saveRelationshipsUsing(function ($component, $state, $record) {
                    $record->permissions()->sync($state ?? []);
                }),*/
            Forms\Components\CheckboxList::make('permissions')
                ->label('الصلاحيات')
                ->options($permissions) // هي مصفوفة من $baseRole فقط
                ->columns(4)
                ->columnSpanFull()
                ->afterStateHydrated(function ($component, $state, $record) {
                    // عند التعديل، حط الصلاحيات الحالية للرول
                    if ($record) {
                        $component->state($record->permissions->pluck('id')->toArray());
                    }
                })
                ->dehydrateStateUsing(fn ($state) => array_values($state)) // رجع IDs مختارة
                ->saveRelationshipsUsing(function ($component, $state, $record) {
                    // Sync permissions المختارة فقط
                    $record->permissions()->sync($state ?? []);
                }),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('اسم الدور')
                ->sortable()->searchable(),
            Tables\Columns\IconColumn::make('to_company')
                ->label('مرئي؟')
                ->boolean(),
            Tables\Columns\TextColumn::make('permissions_count')->counts('permissions')->label('عدد الصلاحيات')
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('permissions.name')
                ->label('الصلاحيات')
                ->badge()
                ->color(function ($state) {
                    $colors = ['primary', 'success', 'info', 'gray', 'danger', 'warning',];
                    $index = crc32($state) % count($colors);
                    return $colors[$index];
                }),

        ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
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

/*
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                //
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}*/
