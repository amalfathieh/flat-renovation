<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'المستخدم';
    protected static ?string $pluralModelLabel = 'المستخدمين';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                Forms\Components\TextInput::make('name')->required(),
//                Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
//                Forms\Components\TextInput::make('password')
//                    ->password()
//                    ->required(fn (string $context): bool => $context === 'create')
//                    ->dehydrateStateUsing(fn (string $state): string => bcrypt($state)),
//                Forms\Components\Select::make('company_id')
//                    ->relationship('company', 'name')
//        // علاقة بالموديل Company ->nullable() // ليكون Super Admin ->label('Associated Company'), Forms\Components\Toggle::make('is_super_admin') ->label('Is Super Admin?'),

                TextInput::make('name')->required()->label('الاسم'),
                TextInput::make('email')->email()->required()->label('البريد الإلكتروني'),

                Select::make('role_name')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->multiple()
                    ->required(),

                DateTimePicker::make('banned_at')->label('تاريخ الحظر'),
                TextInput::make('password')
                    ->label('كلمة المرور')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->required(fn (string $context) => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('الاسم')->searchable(),

                TextColumn::make('email')->label('البريد الإلكتروني')->searchable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label('الدور')
                    ->badge()
                    ->color(function (string $state):string {
                        return match($state){
                            'admin' => 'danger',
                            'control_panel_employee' =>'info',
                            'supervisor' => 'primary',
                            'company' => 'info',
                            'employee' => 'gray',
                            'customer' => 'success'
                        };
                    })
                    ->searchable(),

                IconColumn::make('email_verified_at')
                    ->label('تم التحقق؟')
                    ->boolean(),
                TextColumn::make('banned_at')->label('محظور منذ'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
