<?php

namespace App\Http\Controllers;

use App\Http\Resources\RelatedResource;
use App\Http\Resources\TransactionResource;
use App\Http\Responses\Response;
use App\Models\Transaction;
use App\Models\TransactionsAll;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function getMyTransactions()
    {
        $user = auth()->user()->customerProfile;

        $transactions = $user->sentTransactions()
            ->orWhere(function ($query) use ($user) {
                $query->where('receiver_id', $user->id)
                    ->where('receiver_type', get_class($user));
            })
            ->latest()
            ->get();

        return Response::Success(TransactionResource::collection($transactions), 'All Transactions.');
    }

    public function getRelatedSummary($id, TransactionService $transactionService)
    {
        $transaction = TransactionsAll::find($id);
        if (!$transaction) {
            return Response::Error("Transaction not found", 404);
        }

        $related = $transaction->related;
        if (!$related) {
            return Response::Error("Related not found", 404);
        }

        return Response::Success($transactionService->formatRelatedData($related), 'All Transactions.');
    }

}
