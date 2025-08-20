<?php


namespace App\Services;


class TransactionService
{
    public function formatRelatedData($related)
    {
        return match (get_class($related)) {
            \App\Models\TopUpRequest::class => [
                'topUpRequest_id' => $related->id,
                'receipt_image' => $related->receipt_image,
                'method' => $related->paymentMethod->name ?? null,
                'amount' => $related->amount,
                'status' => $related->status,
                'admin_note' => $related->admin_note,
                'date' => $related->created_at->toDateTimeString(),
            ],
            \App\Models\Order::class => [
                'order_id' => $related->id,
                'status' => $related->status,
                'date' => $related->created_at->toDateTimeString(),
            ],
            \App\Models\ProjectStage::class => [
                'stage_id' => $related->id,
                'stage_name' => $related->name,
                'project_name' => optional($related?->project)->project_name,
                'status' => $related->status,
                'date' => $related->created_at->toDateTimeString(),
            ],

            default => [
                'type' => 'Unknown',
            ],
        };
    }
}
