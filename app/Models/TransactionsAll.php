<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionsAll extends Model
{
    protected $fillable = [
        'invoice_number',
        'payer_id',
        'payer_type',
        'receiver_id',
        'receiver_type',
        'source',
        'amount',
        'note',
        'related_type',
        'related_id',

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',

    ];


    public function payer(): MorphTo
    {
        return $this->morphTo();
    }


    public function receiver(): MorphTo
    {
        return $this->morphTo();
    }



    public function related(): MorphTo
    {
        return $this->morphTo();
    }

    public function company(){
        return $this->receiver()->merge($this->payer());
    }


    public function scopeAdminSubscriptions($query)
    {
        return $query->where('source', 'company_subscription')
            ->where('receiver_type', User::class);
    }


    public function scopeCompanyEarnings($query, $companyId)
    {
        return $query->where('receiver_type', Company::class)
            ->where('receiver_id', $companyId)
            ->whereIn('source', ['user_order_payment', 'user_stage_payment']);
    }


    public function scopeCompanyRefunds($query, $companyId)
    {
        return $query->where('payer_type', Company::class)
            ->where('payer_id', $companyId)
            ->where('source', 'company_deduction_refund');
    }






    public function scopeCompanyExterinal($query, $companyId)
    {
        return $query->where('receiver_type', Company::class)
            ->where('receiver_id', $companyId)
            ->where('source', 'admin_monthly_clearance');
    }





    public function scopeCompanyWithdrawalsPending($query)
    {
        return $this->scopeCompanyEarnings() - $this->scopeCompanyRefunds();
        return $query->where('source', 'admin_monthly_clearance');
    }




}
