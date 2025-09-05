<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';

    protected static ?string $modelLabel = 'الموظف';

    protected static ?string $pluralModelLabel = 'الموظفيين';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('user.id'),

                Tables\Columns\TextColumn::make('first_name')
                    ->label('الاسم الاول')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->label('الاسم الاخير')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('birth_day')
                    ->label('تاريخ الميلاد')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('البريد الإلكتروني')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.roles.name')
                    ->label('الدور')
                    ->badge()
                    ->color(function (string $state):string {
                        return match($state){
                            'admin' => 'danger',
                            'control_panel_employee' =>'gray',
                            'supervisor' => 'primary',
                            'company' => 'info',
                            'employee' => 'info',
                            'customer' => 'success'
                        };
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('starting_date')
                    ->label('تاريخ التعيين')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
