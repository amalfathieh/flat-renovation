<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use App\Notifications\EmployeeInvitationNotification;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'موظف';
    protected static ?string $pluralModelLabel = 'الموظفيين';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'user.roles']);
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('معلومات الاساسية')
                        ->schema([
                            TextInput::make('first_name')
                                ->label('الاسم الاول')
                                ->required(),

                            TextInput::make('last_name')
                                ->label('الاسم الاخير')
                                ->required(),

                            Forms\Components\Fieldset::make('معلومات المستخدم')
                                ->schema([
                                    TextInput::make('user.name')
                                        ->label('اسم المستخدم')
                                        ->required(),

                                    TextInput::make('user.email')
                                        ->label('البريد الإلكتروني')
                                        ->email()
                                        ->required()
                                        ->unique(
                                            table: 'users',
                                            column: 'email',
                                            ignoreRecord: true,
                                            ignorable: fn ($record) => $record?->user
                                        ),

                                    TextInput::make('user.password')
                                        ->label('كلمة المرور (سيتم إنشاء كلمة مؤقتة تلقائياً)')
                                        ->disabled()
                                        ->dehydrated(false)
                                        ->columnSpanFull()
                                        ->helperText('سيتم إرسال كلمة مرور مؤقتة إلى البريد الإلكتروني للموظف')
                                        ->hiddenOn(['edit', 'view'])
                                        ->dehydrated(fn ($state) => filled($state)),

                                    Select::make('user.roles')
                                        ->label('الدور')
                                        ->options(self::getRoles())
                                        ->required()
                                        ->multiple()
                                ])
                        ])->columns(2),

                    Forms\Components\Wizard\Step::make('معلومات الشخصية')
                        ->schema([
                            Select::make('gender')
                                ->label('الجنس')
                                ->options([
                                    'Male' => 'male',
                                    'Female' => 'female'
                                ]),

                            TextInput::make('phone')
                                ->label('رقم الهاتف')
                                ->required(),

                            Forms\Components\DatePicker::make('birth_day')
                                ->label('تاريخ الميلاد')
                                ->required(),

                            Forms\Components\DatePicker::make('starting_date')
                                ->label('تاريخ التعيين')
                                ->required(),
                        ])->columns(2)
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('resend_invitation')
                        ->label('إعادة إرسال الدعوة')
                        ->icon('heroicon-o-envelope')
                        ->action(function (Employee $record) {
                            $tempPassword = Str::random(10);
                            $record->user->update(['password' => bcrypt($tempPassword)]);
                            $record->user->notify(new EmployeeInvitationNotification($tempPassword));

                            Notification::make()
                                ->title('تم إعادة إرسال الدعوة بنجاح')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('معلومات الموظف')
                    ->schema([

                        TextEntry::make('first_name')
                            ->label('الاسم الاول'),

                        TextEntry::make('last_name')
                            ->label('الاسم الاخير'),

                        TextEntry::make('user.name')
                            ->label('اسم المستخدم'),

                   TextEntry::make('user.email')
                       ->label('البريد الإلكتروني'),

                    TextEntry::make('user.roles.name')
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
                       ->label('الدور'),

                    ])->columns(2),

                Section::make('معلومات الشخصية')
                    ->schema([
                        TextEntry::make('gender')
                            ->label('الجنس'),

                        TextEntry::make('phone')
                            ->label('رقم الهاتف'),

                        TextEntry::make('starting_date')
                            ->label('تاريخ التعيين'),

                        TextEntry::make('birth_day')
                            ->label('تاريخ الميلاد'),
                    ])->columns(2),
            ]);

    }

    public static function getRoles(){
        return Role::where('name', '!=', 'employee')->pluck('name', 'name')->toArray();
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
//            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }


}
