<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\ProjectStageResource\Pages;
use App\Filament\Company\Resources\ProjectStageResource\RelationManagers;
use App\Models\Project;
use App\Models\ProjectStage;
use App\Models\Service;
use App\Models\ServiceType;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Enums\ProjectStatusEnum;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProjectStageResource extends Resource
{
    protected static ?string $model = ProjectStage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralModelLabel = 'مراحل المشروع';
    protected static ?string $modelLabel = 'مرحلة';


//    public static function getEloquentQuery(): Builder
//    {
//        $user =  Auth::user();
//        if ($user->hasRole('employee')){
//            $employee = $user->employee;
//
//            return ProjectStage::whereHas('project', function (Builder $query) use ($employee){
//                $query->where('employee_id'  == $employee->id);
//            });
//        }
//        return parent::getEloquentQuery();;
//    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Project')
                            ->schema([
                                Forms\Components\Select::make('project_id')
                                    ->options(function () {
                                        $companyId = Filament::getTenant()?->id;

                                        return Project::
                                        where('company_id', $companyId)
                                            ->get()
                                            ->pluck('project_name','id');
                                    })
                                    ->required(),

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
                                    ->label('الوصف')
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
                                    ->disabled(),
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

    public static function table(Table $table): Table
    {
        return $table
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
            'index' => Pages\ListProjectStages::route('/'),
            'create' => Pages\CreateProjectStage::route('/create'),
            'edit' => Pages\EditProjectStage::route('/{record}/edit'),
        ];
    }
}
