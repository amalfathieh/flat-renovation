<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\OrderResource\Pages;
use App\Http\Controllers\PushNotificationController;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Notifications\SendNotification;
use App\Notifications\StoreNotification;
use App\Services\InvoiceService;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square';
    protected static ?string $pluralModelLabel = 'الطلبات';

    protected static ?string $modelLabel = 'الطلب';
    public static function getNavigationBadge(): ?string
    {
        return parent::getEloquentQuery()->where('status', 'waiting')->count();
    }

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
                //TextColumn::make('location')->label('الموقع'),

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

                Tables\Actions\Action::make('عرض الموقع')
                  ->label('عرض الموقع')
                    ->url(fn ($record) => "https://www.google.com/maps?q={$record->latitude},{$record->longitude}")
                    ->openUrlInNewTab(),





                Tables\Actions\Action::make('قبول')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn($record) => $record->status === 'waiting')
                    ->form([
                        Select::make('employee_id')
                            ->label('اختر الموظف للإشراف على المشروع')
                            ->options(function ($record) {
                                return Employee::where('company_id', $record->company_id)
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


                        $employee = Employee::find($data['employee_id'])->user;

                        $employeePhone = Employee::find($data['employee_id'])->user->phone;

                        $customer = Customer::find($record->customer_id);

                        $user = $customer->user;
                        $customerPhone = $user->payment_phone;

                        $push = new PushNotificationController();

                        if ($user->device_token) {
                            $push->sendPushNotification(
                                'تم قبول طلبك ✅',
                                "تم قبول طلب الكشف. هذا رقم المشرف: {$employeePhone} تواص معه للاتفاق على موعد",
                                $user->device_token
                            );
                            //store notification on database
                            Notification::send($user, new StoreNotification($record->id, 'تم قبول طلبك ✅', "تم قبول طلب الكشف. هذا رقم المشرف: {$employeePhone}", "Order"));

                        }

                        \Filament\Notifications\Notification::make()
                            ->title('تم قبول الطلب وإسناده لموظف ✅')
                            ->success()
                            ->send();

                        //Send Accept Notification to Employee
                        $employee->notify(new SendNotification(
                            $record->id,
                            'تم اشرافك على طلب كشف جديد',
                            "تم تعيينك مشرف على طلب جديد رقم الزبون: {$customerPhone}  معرف الطلب {$record->id}",
                            "Order"));

                    }),



                Tables\Actions\Action::make('رفض')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn($record) => $record->status === 'waiting')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        DB::beginTransaction();

                        try {
                            $company = $record->company;
                            $companyUser = $company->user;
                            $customerUser = $record->customer->user;
                            $amount = $record->cost_of_examination;


                            if ($companyUser->balance < $amount) {
                                DB::rollBack();
                                \Filament\Notifications\Notification::make()
                                    ->title('رصيد الشركة غير كافي لرد المبلغ ❌')
                                    ->danger()
                                    ->send();
                                return;
                            }


                            $record->update([
                                'status' => 'rejected',
                            ]);


                            $companyUser->decrement('balance', $amount);


                            $customerUser->increment('balance', $amount);


                            $service = new \App\Services\InvoiceService();
                            $invoice = $service->generateInvoiceNumber();


                            \App\Models\TransactionsAll::create([
                                'payer_type' => get_class($company),
                                'payer_id' => $company->id,
                                'receiver_type' => get_class($record->customer),
                                'receiver_id' => $record->customer->id,
                                'source' => 'company_deduction_refund',
                                'amount' => $amount,
                                'note' => 'إرجاع مبلغ طلب كشف مرفوض',
                                'related_type' => get_class($record),
                                'related_id' => $record->id,
                                'invoice_number' => $invoice,
                            ]);

                            DB::commit();



                            $push = new PushNotificationController();
                            if ($customerUser->device_token) {
                                $push->sendPushNotification(
                                    'تم رفض طلبك ❌',
                                    'تم رفض طلبك وإعادة النقود إلى رصيدك في التطبيق.',
                                    $customerUser->device_token
                                );

                                //store notification on database
                                Notification::send($customerUser, new StoreNotification($record->id, 'تم رفض طلبك ❌', 'تم رفض طلبك وإعادة النقود إلى رصيدك في التطبيق.', "Order"));

                            }


                            \Filament\Notifications\Notification::make()
                                ->title('تم رفض الطلب واعادة المبلغ للزبون بنجاح ✅')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            DB::rollBack();

                            \Filament\Notifications\Notification::make()
                                ->title('فشل في تنفيذ العملية ❌')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),





            ])
            ->bulkActions([
                    ExportBulkAction::make(),
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
                            ->color(fn(string $state): string => match ($state) {
                                'waiting' => 'info',     // 🔵 أزرق
                                'accepted' => 'success', // ✅ أخضر
                                'rejected' => 'danger',  // ❌ أحمر
                                default => 'gray',
                            }),


                        TextEntry::make('budget')->label('الميزانية'),
                        TextEntry::make('location')->label('الموقع'),
                        TextEntry::make('cost_of_examination')->label('كلفة الكشف'),
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
