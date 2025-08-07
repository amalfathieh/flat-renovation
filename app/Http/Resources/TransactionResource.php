<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        switch ($this->source) {
            case 'user_manual_topup':
                $type = "TopUpRequest";
                $title = "شحن المحفظة";
                break;

            case 'user_order_payment':
                $type = "OrderPayment";
                $title = "دفع كلفة طلب كشف";
                break;

            case 'company_deduction_refund':
                $type = "OrderPayment";
                $title = "استرجاع مبلغ طلب كشف مرفوض";
                break;

            case 'user_stage_payment':
                $type = "StagePayment";
                $title = "دفع كلفة لمرحلة مشروع";
                break;

            default:
                $type = "Unknown";
                $title = "Unknown";
        }


        return [
            'id' => $this->id,
            'title' => $title,
            'type' => $type,
            'invoice_number' => $this->invoice_number,
            'amount' => $this->amount,
            'source' => $this->source,
            'date' => $this->created_at->toDateTimeString(),
            'related_type' => class_basename($this->related_type),
//            'related_summary' => $this->getRelatedSummary(),
            'payer_name' => optional($this->payer)->name  ?? optional($this->payer)->user->name?? 'Unknown',
            'receiver_name' => optional($this->receiver)->name ?? optional($this->receiver)->user->name ?? 'Unknown',
        ];
    }

    protected function getRelatedSummary(): ?array
    {
        if (!$this->related) {
            return null;
        }

        $related = $this->related;

        return match (get_class($related)) {
            \App\Models\TopUpRequest::class => [
//                'type' => 'TopUpRequest',
                'request_id' => $related->id,
                'receipt_image' => $related->receipt_image,
                'method' => $related->paymentMethod->name ?? null,
                'amount' => $related->amount,
                'status' => $related->status,
                'admin_note' => $related->admin_note,
                'date' => $this->created_at->toDateTimeString(),
            ],
            \App\Models\Order::class => [
//                'type' => 'OrderPayment',
                'order_id' => $related->id,
                'status' => $related->status,
                'date' => $this->created_at->toDateTimeString(),
            ],
            \App\Models\ProjectStage::class => [
//                'type' => 'StagePayment',
                'stage_id' => $related->id,
                'stage_name' => $related->name,
                'project_name' => optional($related?->project)->project_name,
                'status' => $related->status,
                'date' => $this->created_at->toDateTimeString(),
            ],

            default => [
                'type' => 'Unknown',
            ],

        };
    }

}
