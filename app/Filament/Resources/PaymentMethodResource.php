<?php


namespace App\Filament\Resources;

use App\Filament\Resources\PaymentMethodResource\Pages;
use App\Models\PaymentMethod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentMethodResource extends Resource
{
    protected static ?string $model = PaymentMethod::class;

    protected static ?string $modelLabel = 'طريقة تحويل';
    protected static ?string $pluralModelLabel = 'طرق التحويل';
    protected static ?string $navigationGroup = 'Payments';
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('بيانات طريقة التحويل')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Toggle::make('is_active')
                            ->label('مفعل')
                            ->default(true),

                        Forms\Components\KeyValue::make('instructions')
                            ->label('التعليمات')
                            ->keyLabel('العنوان')
                            ->valueLabel('التفاصيل')
                            ->nullable(),

                    ]),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('is_active')
                    ->label('الحالة')
                    ->formatStateUsing(fn($state) => $state ? 'مفعل' : 'مقفل')
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ]),

                Tables\Columns\TextColumn::make('instructions')
                    ->label('التعليمات')
                    ->formatStateUsing(function ($state) {
                        if (blank($state)) {
                            return '-';
                        }

                        // تأكد أنو عم يعمل decode
                        $data = is_array($state) ? $state : json_decode($state, true);

                        if (!$data) {
                            return $state; // fallback يعرض النص نفسه
                        }

                        // رجّع البيانات بشكل مرتب
                        return collect($data)
                            ->map(fn($value, $key) => "$key: $value")
                            ->implode("\n"); // فصل بأسطر
                    })
                    ->wrap()
                    ->toggleable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('تعديل'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /*public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('is_active')
                    ->label('الحالة')
                    ->colors([
                        'danger' => fn($state) => $state === false,
                        'success' => fn($state) => $state === true,
                    ])
                    ->formatStateUsing(fn($state) => $state ? 'مفعل' : 'غير مفعل'),

                Tables\Columns\TextColumn::make('instructions')
                    ->label('التعليمات')
                    ->formatStateUsing(function ($state) {
                        if (!is_array($state)) {
                            $state = json_decode($state, true) ?? [];
                        }

                        // رجّع النص بشكل مرتب (العنوان: التفاصيل)
                        return collect($state)
                            ->map(fn($value, $key) => "$key: $value")
                            ->join("\n");
                    })
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->limit(50) // يختصر النص بالطول
                    ->wrap(),   // يسمح باللف بالسطر


                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('آخر تعديل')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('مفعل')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }*/

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentMethods::route('/'),
            'create' => Pages\CreatePaymentMethod::route('/create'),
            'edit' => Pages\EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}
