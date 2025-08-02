<?php

namespace App\Filament\Company\Widgets;

use App\Models\CompanySubscription;
use App\Models\SubscriptionPlan;
use Filament\Facades\Filament;
use Filament\Widgets\Widget;

class AvailablePlans extends Widget
{
    protected static string $view = 'filament.company.widgets.available-plans';
    protected int | string | array $columnSpan = 'full'; // حتى ياخذ عرض كامل

    protected static ?string $pollingInterval = '15s';
    protected static bool $isLazy = true;

    protected static ?int $sort = 2;


    public function getPlans()
    {
        $plans = SubscriptionPlan::where('is_active', true)->get();
        $company = Filament::getTenant();
        $comSub = CompanySubscription::where('company_id', $company->id)->get();

        $data = [
            "plans" => $plans,
            "comSub" => $comSub,

        ];
        return $data;
        return SubscriptionPlan::where('is_active', true)->get();
    }
}
