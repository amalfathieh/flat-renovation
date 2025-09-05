<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExternalTransferDashboardResource\Pages;
use App\Filament\Resources\ExternalTransferDashboardResource\RelationManagers;
use App\Models\Company;
use App\Models\ExternalTransferDashboard;
use App\Models\TransactionsAll;


use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Notifications\Notification;



class ExternalTransferDashboardResource extends Resource
{


    protected static ?string $model = \App\Models\Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'قائمة أرباح الشركات';
    protected static ?string $navigationGroup = 'الإدارة المالية';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }






    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('اسم الشركة')
                    ->searchable(),

                TextColumn::make('earnings')
                    ->label('إجمالي الأرباح')
                    ->getStateUsing(fn ($record) =>
                    number_format(
                        TransactionsAll::companyEarnings($record->id)->sum('amount')
                        - TransactionsAll::companyRefunds($record->id)->sum('amount'),
                        2
                    )
                    ),

                TextColumn::make('transferred')
                    ->label('المحولة مسبقاً')
                    ->getStateUsing(fn ($record) =>
                    number_format(
                        TransactionsAll::companyExterinal($record->id)->sum('amount'),
                        2
                    )
                    ),

                TextColumn::make('available')
                    ->label('الرصيد المتبقي')
                    ->getStateUsing(fn ($record) =>
                    number_format(
                        (TransactionsAll::companyEarnings($record->id)->sum('amount')
                            - TransactionsAll::companyRefunds($record->id)->sum('amount'))
                        - TransactionsAll::companyExterinal($record->id)->sum('amount'),
                        2
                    )
                    ),
            ])
            ->filters([

            ])
            ->actions([

                TableAction::make('external_transfer')
                    ->label('تحويل خارجي')
                    ->form([
                        TextInput::make('amount')
                            ->label('المبلغ')
                            ->numeric()
                            ->required()
                            ->rule(function ($record) {
                        return function (string $attribute, $value, \Closure $fail) use ($record) {

                            $available =
                                (TransactionsAll::companyEarnings($record->id)->sum('amount')
                                    - TransactionsAll::companyRefunds($record->id)->sum('amount'))
                                - TransactionsAll::companyExterinal($record->id)->sum('amount');

                            if ($value > $available || $value<=0 ) {
                                $fail("المبلغ المدخل أكبر من الرصيد المتبقي لهذه الشركة (الرصيد: {$available}).");

                            }
                        };
                            }),


                        FileUpload::make('receipt_image')
                            ->label('إرفاق الإيصال')
                            ->image()
                            ->nullable(),
                        TextInput::make('invoice_number')
                            ->label('رقم الفاتورة')
                            ->nullable(),

                        Hidden::make('company_id')
                            ->default(fn ($record) => $record->id),
                        Hidden::make('admin_id')
                            ->default(fn () => auth()->id()),
                    ])
                    ->action(function ($record, array $data, $livewire) {
                        \App\Models\ExternalTransfer::create($data);




                        TransactionsAll::create([
                            'payer_type' => User::class,
                            'payer_id' =>auth()->id(),
                            'receiver_type' => Company::class,
                            'receiver_id' => $record->id,
                            'source' => 'admin_monthly_clearance',
                            'amount' => $data['amount'],
                            'invoice_number'=> $data['invoice_number'],
                            'note' => 'تحويل خارجي لشركة ' . $record->name,

                        ]);

                        Notification::make()
                            ->title('تم بنجاح')
                            ->body('تمت إضافة التحويل الخارجي بنجاح.')
                            ->success()
                            ->send();

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExternalTransferDashboards::route('/'),

            //'create' => Pages\CreateExternalTransferDashboard::route('/create'),
           // 'edit' => Pages\EditExternalTransferDashboard::route('/{record}/edit'),
        ];
    }
}
