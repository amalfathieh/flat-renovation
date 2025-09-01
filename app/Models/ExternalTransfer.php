<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalTransfer extends Model
{


    protected $fillable = [
        'admin_id',
        'company_id',
        'amount',
        'receipt_image',
        'invoice_number',

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];


    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }



    public function transactionsAll()
    {
        return $this->morphOne(TransactionsAll::class, 'related');
    }

}
