<?php

namespace App\Filament\Company\Pages;

use App\Models\TransactionsAll;
use Filament\Facades\Filament;
use Filament\Pages\Page;

class StatisticsCompany extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.company.pages.statistics-company';

//    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static ?string $navigationLabel = 'احصائيات';

    public function getCompanyEarnings()
    {
        $company = Filament::getTenant();

        return TransactionsAll::companyEarnings($company->id)->sum('amount');
    }

    public function getCompanyRefunds()
    {
        $company = Filament::getTenant();

        return TransactionsAll::companyRefunds($company->id)->sum('amount');
    }

    public function getNetProfit()
    {
        return $this->getCompanyEarnings() - $this->getCompanyRefunds();
    }
}
