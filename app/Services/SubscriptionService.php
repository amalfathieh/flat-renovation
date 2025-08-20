<?php


namespace App\Services;


use App\Events\ConfirmCompanySubscription;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\DB;

class SubscriptionService
{
    public function subscribe($user, $planId)
    {

        $plan = SubscriptionPlan::findOrFail($planId);
        $company = $user->company;

        if ($company->activeSubscription) {
            return ['success' => false, 'error' => 'أنت مشترك بالفعل'];
        }

        if ($plan->price > $user->balance) {
            return ['success' => false, 'error' => 'رصيدك غير كافي'];
        }

        DB::transaction(function () use ($company, $plan, $user) {
            $company->companySubscriptions()->create([
                'subscription_plan_id' => $plan->id,
                'start_date' => now(),
                'end_date'   => now()->addDays($plan->duration_in_days),
            ]);

            event(new ConfirmCompanySubscription($user, $user->company, $plan));
        });

        return ['success' => true, 'message' => 'تم الاشتراك بنجاح!'];
    }
}
