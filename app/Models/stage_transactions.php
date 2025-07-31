<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stage_transactions extends Model
{

    protected $fillable = [
        'project_stage_id',
        'company_id',
        'customer_id',
        'payment_intent_id',
        'type',
        'amount',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];


    public function stage()
    {
        return $this->belongsTo(ProjectStage::class, 'project_stage_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }




}


