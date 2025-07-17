<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\ProjectResource\Pages;
use App\Filament\Company\Resources\ProjectResource\RelationManagers;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Project;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Enums\ProjectStatusEnum;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralModelLabel = 'المشاريع';
    protected static ?string $modelLabel = 'مشروع';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Order')
                            ->schema([
                                Forms\Components\Select::make('order_id')
                                    ->label('Order')
                                    ->options(function () {
                                        $companyId = Filament::getTenant()?->id;

                                        return Order::where('company_id', $companyId)
                                            ->get()
                                            ->pluck('id', 'id');
                                    })
                                    ->searchable()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $order = \App\Models\Order::with('customer.user')->find($state);

                                        if ($order && $order->customer && $order->customer->user) {
                                            $set('customer_name', $order->customer->user->name);
                                        } else {
                                            $set('customer_name', 'غير معروف');
                                        }
                                    }),

                                Forms\Components\TextInput::make('customer_name')
                                    ->label('Customer Name')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required(),

                                Forms\Components\Select::make('employee_id')
                                    ->label('الموظف المسؤول')
                                    ->options(function () {
                                        $companyId = Filament::getTenant()?->id;

                                        return Employee::where('company_id', $companyId)
                                            ->get()
                                            ->pluck('first_name', 'id');
                                    })
                                    ->searchable()
                                    ->required()
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('project_name')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\MarkdownEditor::make('description')
                                    ->columnSpanFull(),

                            ]),
                    ]),
                Forms\Components\Group::make()
                     ->schema([
                         Forms\Components\Section::make('Status')
                             ->schema([
                                 Forms\Components\DatePicker::make('start_date')
                                     ->required(),
                                 Forms\Components\DatePicker::make('end_date'),

                                 Forms\Components\Select::make('status')
                                     ->options(ProjectStatusEnum::options())->required(),


                                 Forms\Components\TextInput::make('final_cost')
                                     ->numeric(),

                             Forms\Components\Toggle::make('is_publish')
                                 ->label('نشر المشروع')
                                 ->reactive()
                                 ->disabled(fn(callable $get) => $get('status') !== 'finished')
                                 ->helperText("يمكن النشر فقط عندما تكون حالة المشروع مكتمل")
                                ->columnSpanFull(),

                         ])->columns(2),

                     Forms\Components\Section::make('File')
                         ->schema([
                             Forms\Components\FileUpload::make('file')
                                 ->directory('project-files')
                                 ->preserveFilenames()
                         ])->collapsible(),


                    ]),

             ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('اسم الزبون')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_id')
                    ->label('معرف الطلب')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('employee.first_name')
                    ->label('اسم الموظف')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project_name')
                    ->label('اسم المشروع')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة'),

                Tables\Columns\IconColumn::make('is_publish')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            RelationManagers\ProjectStagesRelationManager::class,
        ];
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('id'),

                TextEntry::make('customer_name')
                    ->label('اسم الزبون'),

                TextEntry::make('employee.first_name')
                    ->label('اسم الموظف'),

                TextEntry::make('project_name')
                    ->label('اسم المشروع'),

                TextEntry::make('status'),

                TextEntry::make('description'),

                TextEntry::make('final_cost'),

                TextEntry::make('file'),

                TextEntry::make('is_publish'),

                TextEntry::make('start_date')
                    ->date(),
                TextEntry::make('end_date')
                    ->date(),

                TextEntry::make('created_at')
                    ->date(),
                TextEntry::make('file'),

            ])->columns(2);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
