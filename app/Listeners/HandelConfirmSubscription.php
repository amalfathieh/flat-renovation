<?php

namespace App\Listeners;

use App\Events\ConfirmCompanySubscription;
use App\Models\TransactionsAll;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class HandelConfirmSubscription
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ConfirmCompanySubscription $event): void
    {
        $user = $event->user;
        $company = $event->company;
        $plan = $event->plan;
        $admin  = User::role('admin')->first();

        $user->decrement('balance', $plan->price);

        DB::transaction(function () use ($admin, $company, $user, $plan) {
            // خصم الرصيد من الشركة
            $user->decrement('balance', $plan->price);

            //اضافة رصيد للادمن
            $admin->increment('balance', $plan->price);

            // سجل المعاملة
            TransactionsAll::create([
                'invoice_number' => random_int(100000, 9999999),
                'payer_type'     => get_class($company),
                'payer_id'       => $company->id,
                'receiver_type'  => get_class($admin),
                'receiver_id'    => $admin->id,
                'source'         => 'company_subscription',
                'amount'         => $plan->price,
                'note'           => "اشتراك في الباقة {$plan->name} لمدة {$plan->duration_in_days} يوم",
                'related_type'   => get_class($plan),
                'related_id'     => $plan->id,
            ]);
        });
    }
}
