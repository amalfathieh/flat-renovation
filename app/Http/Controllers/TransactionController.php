<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\TransactionsAll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function getMyTransactions(Request $request)
    {
        $customer = Auth::user()->customerProfile;

        $transactions = TransactionsAll::with(['payer', 'receiver', 'related'])->where(function ($query) use ($customer) {
            $query->where('payer_id', $customer->id)
                ->where('payer_type', get_class($customer));
        })
            ->orWhere(function ($query) use ($customer) {
                $query->where('receiver_id', $customer->id)
                    ->where('receiver_type', get_class($customer));
            })
            ->latest()
            ->paginate(10);

        return Response::Success($transactions, 'All Transactions.');
    }
}
