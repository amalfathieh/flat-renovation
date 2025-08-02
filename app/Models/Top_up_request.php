<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stripe\PaymentMethod;

class Top_up_request extends Model
{

    protected $fillable = [
        'requester_id', 'requester_type', 'amount', 'receipt_image', 'status', 'admin_note','Invoice_number',
    ];



    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',

    ];

    public function requester()
    {
        return $this->morphTo();
    }


    public function transactionsAll()
    {
        return $this->morphOne(TransactionsAll::class, 'related');
    }


    public function paymentMethod()
    {
        return $this->belongsTo(payment_method::class);
    }



}
