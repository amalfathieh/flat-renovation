<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TopUpRequest extends Model
{

    protected $fillable = [
        'requester_id', 'requester_type', 'amount', 'receipt_image', 'status', 'admin_note','invoice_number','payment_method_id'
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
        return $this->belongsTo(PaymentMethod::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'requester_id');
    }


}
