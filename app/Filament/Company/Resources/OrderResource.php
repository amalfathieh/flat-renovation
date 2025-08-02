<?php

namespace App\Filament\Company\Resources;
use App\Filament\Company\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralModelLabel = 'الطلبات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')->label('رقم الطلب'),
                TextColumn::make('customer.user.name')->label('الزبون'),
                TextColumn::make('company.name')->label('الشركة'),
                TextColumn::make('employee.user.name')->label('الموظف المشرف'),

                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->colors([
                        'info' => 'waiting',
                        'success' => 'accepted',
                        'danger' => 'rejected',
                    ]),

                TextColumn::make('budget')->label('الميزانية'),
                TextColumn::make('location')->label('الموقع'),
                TextColumn::make('created_at')->label('تاريخ الإنشاء')->date(),
                TextColumn::make('cost_of_examination')->label('كلفة الكشف بالدولار'),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'waiting' => 'بانتظار المراجعة',
                        'accepted' => 'مقبولة',
                        'rejected' => 'مرفوضة',
                    ]),

            ])
            ->actions([
               //Tables\Actions\EditAction::make(),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),


                Tables\Actions\Action::make('قبول')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'waiting')
                    ->form([
                        \Filament\Forms\Components\Select::make('employee_id')
                            ->label('اختر الموظف للإشراف على المشروع')
                            ->options(function ($record) {
                                return \App\Models\Employee::where('company_id', $record->company_id)
                                    ->with('user')
                                    ->get()
                                    ->pluck('user.name', 'id');
                            })
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => 'accepted',
                            'employee_id' => $data['employee_id'],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('تم قبول الطلب وإسناده لموظف ✅')
                            ->success()
                            ->send();
                    }),







                Tables\Actions\Action::make('رفض')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'waiting')
                    ->requiresConfirmation()
                    ->action(function ($record) {

                        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

                        try {

                            $refund = \Stripe\Refund::create([
                                'payment_intent' => $record->payment_intent_id,
                            ]);


                            $record->update([
                                'status' => 'rejected',
                                'refund_id' => $refund->id,
                            ]);


                            $company = $record->company;
                            $amount = $record->cost_of_examination;


                            if ($company->balance >= $amount) {
                                $company->decrement('balance', $amount);


                                \App\Models\Transaction::create([
                                    'company_id' => $company->id,
                                    'order_id' => $record->id,
                                    'type' => 'debit',
                                    'amount' => $amount,
                                ]);
                            } else {

                                \Filament\Notifications\Notification::make()
                                    ->title('رصيد الشركة غير كافي لخصم المبلغ')
                                    ->warning()
                                    ->send();
                            }

                            \Filament\Notifications\Notification::make()
                                ->title('تم رفض الطلب واسترجاع المبلغ بنجاح ✅')
                                ->success()
                                ->send();

                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('فشل في استرجاع المبلغ ❌')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),








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







    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('معلومات الطلب')
                    ->schema([
                        TextEntry::make('id')->label('رقم الطلب'),
                        TextEntry::make('customer.user.name')->label('اسم الزبون'),
                        TextEntry::make('company.name')->label('اسم الشركة'),
                        TextEntry::make('status')
                            ->label('الحالة')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'waiting' => 'info',     // 🔵 أزرق
                                'accepted' => 'success', // ✅ أخضر
                                'rejected' => 'danger',  // ❌ أحمر
                                default => 'gray',
                            }),


                        TextEntry::make('budget')->label('الميزانية'),
                        TextEntry::make('location')->label('الموقع'),
                        TextEntry::make('cost_of_examination')->label('كلفة الكشف بالدولار'),
                        TextEntry::make('created_at')
                            ->label('تاريخ الإنشاء')
                            ->date(),
                    ]),
            ]);
    }






    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }


    public static function canCreate(): bool
    {
        return false;
    }


    public static function canDelete(Model $record): bool
    {
        return $record->status === 'rejected';
    }


}
