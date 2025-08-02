<?php

namespace App\Filament\Company\Widgets;

use App\Models\Order;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;
use App\Enums\OrderStatusEnum;
use Illuminate\Support\Facades\DB;


class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $companyId = Filament::getTenant()?->id;
        $data = Order::select('status', DB::raw('count(*) as count'))
            ->where('company_id', $companyId)
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => array_values($data)
                ]
            ],
            'labels' => OrderStatusEnum::cases()
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
