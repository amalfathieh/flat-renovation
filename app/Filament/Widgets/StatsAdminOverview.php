<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\ExternalTransfer;
use App\Models\Project;
use App\Models\TransactionsAll;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $customerCount = Customer::whereHas('projects')
            ->distinct('customers.id')
            ->count('customers.id');

        $ordersCount = Customer::whereHas('orders')
            ->distinct('customers.id')
            ->count('customers.id');

        return [

            Stat::make('المستخدميين', User::query()->count())
                ->description('عدد المستخدمين الكلي')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('info')
                ->chart([7, 3, 4, 2, 1, 6, 4]),

            Stat::make('الشركات', Company::query()->count())
                ->description('عدد الشركات الكلي')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('primary')
                ->chart([7,3,4,7,8,9,6,0,9]),

            Stat::make('الموظفون', Employee::count())
                ->description('عدد الموظفين بجميع الشركات')
                ->descriptionIcon('heroicon-o-users')
                ->color('info')
                ->chart([7, 3, 4, 2, 1, 6, 4]),

            Stat::make('الزبائن', Customer::count())
                ->description('عدد مستخدمي تطبيق الموبيل')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary')
                ->chart([1, 10, 4, 7, 8, 6, 5, 2]),

            Stat::make('العملاء', $customerCount)
                ->description('عدد العملاء الذين لديهم مشروع على الاقل')
                ->descriptionIcon('heroicon-o-users')
                ->color('success')
                ->chart([1, 10, 4, 7, 8, 6, 5, 2]),

            Stat::make('العملاء', $ordersCount)
                ->description('عدد العملاء المقدمين طلبات')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary')
                ->chart([1, 10, 4, 7, 8, 6, 5, 2]),

            Stat::make('المشاريع', Project::count())
                ->description('إجمالي المشاريع')
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('warning')
                ->chart([7, 3, 4, 7, 8, 9, 6, 5, 9]),

            Stat::make(
                'الأرباح',TransactionsAll::adminEarnings(auth()->user()->id)->sum('amount'))
                ->description('ارباح اشتراكات الشركات')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success')
                ->chart([5, 8, 6, 7, 9, 10, 8, 6]),

            Stat::make('التحويلات الخارجية', ExternalTransfer::sum('amount'))
                ->description('إجمالي التحويلات الخارجية للشركات المكتملة')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success')
                ->chart([3, 6, 9, 8, 10, 7, 12, 15]),

            Stat::make('المتبقي للتحويل',
                TransactionsAll::allCompanyEarnings()->sum('amount')
                - TransactionsAll::allCompanyRefunds()->sum('amount')
                - ExternalTransfer::sum('amount')
            )
                ->description('المبلغ المتبقي الواجب تحويله')
                ->descriptionIcon('heroicon-o-arrow-uturn-left')
                ->color('danger')
                ->chart([5, 8, 6, 7, 9, 10, 8, 6]),
        ];
    }
}
