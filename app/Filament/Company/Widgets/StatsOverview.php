<?php

namespace App\Filament\Company\Widgets;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Project;
use App\Models\TransactionsAll;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Enums\OrderStatusEnum;
use App\Enums\ProjectStatusEnum;


class StatsOverview extends BaseWidget
{

    protected static ?string $pollingInterval = '15s';

    protected static ?int $sort = 1;

    protected static bool $isLazy = true;

    protected function getStats(): array
    {

        $companyId = Filament::getTenant()?->id;

        $customerCount = Customer::whereHas('projects', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })
            ->distinct('customers.id')
            ->count('customers.id');

        return [
            Stat::make('الموظفون', Employee::where('company_id', $companyId)->count())
                ->description('عدد الموظفين')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('info')
                ->chart([7, 3, 4, 2, 1, 6, 4]),

            Stat::make('العملاء', $customerCount)
                ->description('عدد العملاء')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary')
                ->chart([1, 10, 4, 7, 8, 6, 5, 2]),

            Stat::make('المشاريع', Project::where('company_id', $companyId)->count())
                ->description('إجمالي المشاريع')
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('warning')
                ->chart([7, 3, 4, 7, 8, 9, 6, 5, 9]),

            Stat::make('المشاريع المنجزة', Project::where('company_id', $companyId)
                ->where('status', ProjectStatusEnum::FINISHED->value)->count())
                ->description('مشاريع مكتملة')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success')
                ->chart([7, 8, 10, 7, 8, 3, 6, 4]),

            Stat::make('الطلبات', Order::where('company_id', $companyId)->count())
                ->description('إجمالي الطلبات')
                ->descriptionIcon('heroicon-o-clipboard-document-list')
                ->color('warning')
                ->chart([2, 5, 3, 6, 8, 4, 7, 5]),

            Stat::make('إجمالي الأرباح (كشف شقة أو مرحلة)', TransactionsAll::companyEarnings($companyId)->sum('amount'))
                ->description('الأرباح من العملاء')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('success')
                ->chart([3, 6, 9, 8, 10, 7, 12, 15]),

            Stat::make('المبالغ المرجعة (رد فلوس للزبون)', TransactionsAll::companyRefunds($companyId)->sum('amount'))
                ->description('المبالغ المسترجعة')
                ->descriptionIcon('heroicon-o-arrow-uturn-left')
                ->color('danger')
                ->chart([1, 4, 2, 6, 3, 7, 5, 2]),


            Stat::make(
                'الأرباح الصافية',
                TransactionsAll::companyEarnings($companyId)->sum('amount')
                    - TransactionsAll::companyRefunds($companyId)->sum('amount')
            )
                ->description('إجمالي الأرباح بعد الحسم')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success')
                ->chart([5, 8, 6, 7, 9, 10, 8, 6]),
        ];
    }
}
