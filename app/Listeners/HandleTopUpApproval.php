<?php

namespace App\Listeners;

use App\Events\TopUpApproved;
use App\Models\TransactionsAll;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class HandleTopUpApproval
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

    public function handle(TopUpApproved $event): void
    {
        $request = $event->request;

        DB::transaction(function () use ($request) {
            $requester = $request->requester;

            // زيادة الرصيد
            $requester->user->increment('balance', $request->amount);

            // سجل المعاملة
            TransactionsAll::create([
                'invoice_number' =>$request->invoice_number ?? random_int(100000, 9999999),
                'payer_type'     => null,
                'payer_id'       => null,
                'receiver_type'  => get_class($requester),
                'receiver_id'    => $requester->id,
                'source'         => $requester instanceof \App\Models\Company
                    ? 'company_manual_topup'
                    : 'user_manual_topup',
                'amount'         => $request->amount,
                'note'           => 'Approved top-up by admin. '.$request->note,
                'related_type'   => get_class($request),
                'related_id'     => $request->id,
            ]);
        });
    }
}
