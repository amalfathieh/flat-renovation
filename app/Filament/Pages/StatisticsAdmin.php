<?php

namespace App\Filament\Pages;

use App\Models\Company;
use App\Models\TransactionsAll;
use Filament\Pages\Page;
use Illuminate\Support\Collection;

class StatisticsAdmin extends Page
{
//    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.statistics-admin';

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'احصائيات';
    protected static ?string $title = 'لوحة تحكم الإدمن';

    public Collection $companiesSummary;
    public float $adminSubscriptionsProfit;

    public function mount()
    {
        // إجمالي أرباح الإدمن من الاشتراكات
        $this->adminSubscriptionsProfit = TransactionsAll::where('source', 'company_subscription')
            ->where('receiver_type', 'App\\Models\\Admin')
            ->sum('amount');

        // ملخص الشركات
        $this->companiesSummary = Company::all()->map(function ($company) {
            $totalFromCustomers = TransactionsAll::where('receiver_type', Company::class)
                ->where('receiver_id', $company->id)
                ->whereIn('source', ['user_order_payment', 'user_stage_payment'])
                ->sum('amount');

            $totalTransferred = TransactionsAll::where('payer_type', Company::class)
                ->where('payer_id', $company->id)
                ->where('source', 'admin_monthly_clearance')
                ->sum('amount');

            return [
                'name' => $company->name,
                'total_from_customers' => $totalFromCustomers,
                'total_transferred' => $totalTransferred,
                'remaining' => $totalFromCustomers - $totalTransferred,
            ];
        });
    }
}
