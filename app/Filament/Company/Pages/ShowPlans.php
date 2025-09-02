<?php

namespace App\Filament\Company\Pages;

use App\Models\SubscriptionPlan;
use Filament\Facades\Filament;
use Filament\Pages\Page;

class ShowPlans extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $title = "خطط الاشتراك";

    protected static string $view = 'filament.company.pages.show-plans';


    public static function canView(): bool
    {
        return false;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->hasRole('company');
    }

    public function getPlans()
    {
        $plans = SubscriptionPlan::where('is_active', true)->get();
        $company = Filament::getTenant();
        $comSub = $company->activeSubscription;

        $data = [
            "plans" => $plans,
            "comSub" => $comSub,

        ];
        return $data;
    }
}
