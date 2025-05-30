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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label('الاسم'),
                TextInput::make('email')->email()->required()->label('البريد الإلكتروني'),
                TextInput::make('phone')->label('رقم الهاتف'),
                Select::make('role_name')
                    ->relationship('roles', 'name')
                    ->preload(),
//                    ->label('الدور')
//                    ->options([
//                        'admin' => 'مدير',
//                        'editor' => 'محرر',
//                        'user' => 'مستخدم',
//                    ])
//                    ->required(),
                DateTimePicker::make('banned_at')->label('تاريخ الحظر'),
                TextInput::make('password')
                    ->label('كلمة المرور')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->required(fn (string $context) => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
//                    ->label('كلمة المرور الجديدة'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('الاسم')->searchable(),
                TextColumn::make('email')->label('البريد الإلكتروني')->searchable(),
                TextColumn::make('phone')->label('الهاتف'),
                TextColumn::make('role_name')->label('الدور'),
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
