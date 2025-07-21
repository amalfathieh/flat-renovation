<?php

namespace App\Filament\Company\Resources\ProjectResource\RelationManagers;

use App\Models\Project;
use App\Models\Service;
use App\Models\ServiceType;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Enums\ProjectStatusEnum;
use Illuminate\Support\Collection;

class ProjectStagesRelationManager extends RelationManager
{
    protected static string $relationship = 'projectStages';

    protected static ?string $pluralModelLabel = 'مراحل المشروع';
    protected static ?string $modelLabel = 'مرحلة';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Project')
                            ->schema([

                                Forms\Components\TextInput::make('stage_name')
                                    ->label('اسم المرحلة')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\Select::make('service_id')
                                    ->label('اسم الخدمة')
                                    ->options(function () {
                                        $companyId = Filament::getTenant()?->id;

                                        return Service::
                                        where('company_id', $companyId)
                                            ->get()
                                            ->pluck('name', 'id');
                                    })
                                    ->native(false)
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->required(),

                                Forms\Components\Select::make('service_type_id')
                                    ->label('نوع الخدمة')
                                    ->options( fn(Get $get): Collection => ServiceType::query()
                                        ->where('service_id', $get('service_id'))
                                        ->pluck('name', 'id'))
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->required(),

                                Forms\Components\MarkdownEditor::make('description')
                                    ->columnSpanFull(),
                            ])->columns(2),
                    ]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([

                                Forms\Components\DatePicker::make('started_at')
                                    ->label('تاريخ البداية'),

                                Forms\Components\DatePicker::make('completed_at')
                                    ->label('تاريخ النهاية'),

                                Forms\Components\Select::make('status')
                                    ->label('الحالة')
                                    ->options(ProjectStatusEnum::options())
                                    ->default('Preparing'),

                                Forms\Components\TextInput::make('cost')
                                    ->label('التكلفة')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\Toggle::make('is_confirmed')
                                    ->label('تم التاكيد؟')
                                    ->required(),
                            ])->columns(2),

                        Forms\Components\Section::make()
                            ->schema([
                                Repeater::make('imagesStage')
                                    ->relationship('imagesStage') // اسم العلاقة من Model
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('صورة المرحلة')
                                            ->directory('project-stage-images')
                                            ->image()
                                            ->imagePreviewHeight('100')
                                            ->preserveFilenames()
                                            ->reorderable()
                                            ->downloadable(),
                                    ])
                                    ->columnSpanFull()
                                    ->label('صور المرحلة'),
                            ])->columns(2),

                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('stage_name')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.project_name')
                    ->label('اسم المشروع')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stage_name')
                    ->label('عنوان المرحلة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('حالة'),
                Tables\Columns\TextColumn::make('cost')
                    ->label('التكلفة')
                    ->money()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_confirmed')
                    ->label('مؤكد؟')
                    ->boolean(),
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
