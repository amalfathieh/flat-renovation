<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\ObjectionResource\Pages;
use App\Filament\Company\Resources\ObjectionResource\RelationManagers;
use App\Models\Objection;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObjectionResource extends Resource
{
    protected static ?string $model = Objection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_stage_id')
                    ->relationship('projectStage', 'stage_name')
                    ->label('المرحلة')
                    ->searchable()
                    ->required(),

                Select::make('customer_id')
                    ->relationship('customer.user', 'name') // إذا عندك علاقة customer
                    ->label('العميل')
                    ->required(),

                Textarea::make('text')
                    ->label('نص الاعتراض')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('projectStage.project.project_name')->label('المشروع'),
                TextColumn::make('customer.user.name')->label('العميل'),
                TextColumn::make('projectStage.stage_name')->label('المرحلة'),
                TextColumn::make('text')->label('نص الاعتراض')->limit(50),
                TextColumn::make('created_at')->label('تاريخ الإضافة')->date(),
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
            'index' => Pages\ListObjections::route('/'),
            'create' => Pages\CreateObjection::route('/create'),
            'edit' => Pages\EditObjection::route('/{record}/edit'),
        ];
    }

   /* public static function getEloquentQuery(): Builder
    {
        $user = Filament::auth()->user();


        if ($user->hasRole('admin')) {
            return parent::getEloquentQuery();
        }


        if ($user->hasRole('company')) {
            return parent::getEloquentQuery()
                ->whereHas('projectStage.project', function ($q) use ($user) {
                    $q->where('company_id', $user->company_id);
                });
        }


        if ($user->hasRole('employee')) {
            return parent::getEloquentQuery()
                ->whereHas('projectStage.project', function ($q) use ($user) {
                    $q->where('employee_id', $user->id);
                });
        }


        return parent::getEloquentQuery()->whereRaw('0 = 1');
    }*/
}
