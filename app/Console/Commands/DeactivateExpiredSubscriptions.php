<?php

namespace App\Console\Commands;

use App\Models\CompanySubscription;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;

class DeactivateExpiredSubscriptions extends Command
{
    protected $signature = 'subscriptions:deactivate-expired';
    protected $description = 'Deactivate subscriptions that have expired';

    public function handle()
    {
//        \Log::info('DeactivateExpiredSubscriptions command ran!');
        $expiredSubscriptions = CompanySubscription::where('status', 'active')
            ->whereDate('end_date', '<', now())
            ->get();

        foreach ($expiredSubscriptions as $subscription) {
            $subscription->update(['status' => 'expired']);
            $this->info("Deactivated subscription ID: {$subscription->id}");
        }

        $this->info('Expired subscriptions deactivated successfully.');

    }

//    public function schedule(Schedule $schedule): void
//    {
//        $schedule->command(static::class)->daily(); // ← هنا الجدولة
//    }
}
