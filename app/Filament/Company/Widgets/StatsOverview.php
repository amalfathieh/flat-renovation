<?php

namespace App\Filament\Company\Widgets;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Project;
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
        return [
            Stat::make('Total Employees', Employee::where('company_id', $companyId)->count())
                ->description('Employees')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([7,3,4,2,1,6,0]),

            Stat::make('Total Projects', Project::where('company_id', $companyId)->count())
                ->description('Projects')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([7,3,4,7,8,9,6,0,9]),

            Stat::make('Finished Projects', Project::where('company_id', $companyId)->where('status', ProjectStatusEnum::FINISHED->value)->count())
                ->description('Finished Projects')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7,8,10,7,8,3,6,0]),

            Stat::make('Waiting Orders', Order::where('status', OrderStatusEnum::WAITING->value)->where('company_id', $companyId)->count())
                ->description('Waiting Orders in app')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7,3,4,7,8,9,6,0,9])

        ];
    }
}
