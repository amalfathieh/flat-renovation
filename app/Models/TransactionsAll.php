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
        'status',
        'note',
        'related_type',
        'related_id',

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',

    ];

    // ✅ الطرف الذي قام بالدفع (زبون أو شركة أو أدمن)
    public function payer(): MorphTo
    {
        return $this->morphTo();
    }

    // ✅ الطرف الذي استلم المال (شركة أو أدمن أو زبون)
    public function receiver(): MorphTo
    {
        return $this->morphTo();
    }



    public function related(): MorphTo
    {
        return $this->morphTo();
    }


//    public function company(){
//        return $this->belongsTo(Company::class,  'receiver_id', '', 'receivedTransactions');
//    }

    public function company(){
        return $this->receiver()->merge($this->payer());
    }
//    public function company(){
//        return $this->payer()->merge($this->receiver());
//    }
//    public function company(){
//        return $this->belongsTo(Company::class,  'payer_id', '', 'transactions');
//    }



}
