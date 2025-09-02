<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\CompanySubscription;
use App\Notifications\SendNotification;
use App\Notifications\SubscriptionEndingSoon;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class NotifyExpiringSubscriptions extends Command
{
    protected $signature = 'subscriptions:notify-expiring';
    protected $description = 'إرسال إشعار للشركات التي أوشكت اشتراكاتها على الانتهاء';

    public function handle(): void
    {
        $now = Carbon::now();
        $threshold = $now->copy()->addDays(3); // 3 أيام قبل الانتهاء

        $subscriptions = CompanySubscription::whereDate('end_date', '<=', $threshold)
            ->whereDate('end_date', '>=', $now)
            ->where('status', 'active')
            ->get();

        foreach ($subscriptions as $subscription) {
            $company = $subscription->company->user;
            if ($company) { // بافتراض عندك علاقة admin -> User

                //Send Accept Notification to Employee
                $company->notify(new SendNotification(
                    $subscription->id,
                    '⚠️ تنبيه: اشتراكك على وشك الانتهاء',
                    "اشتراك شركتك {$company->name} ({$subscription->end_date })سينتهي بتاريخ.
                     الرجاء تجديد الاشتراك لتفادي إيقاف الخدمات. ",
                    "Sub"));

            }
        }

        $this->info("تم إرسال إشعارات لعدد: {$subscriptions->count()} شركات.");
    }
}
