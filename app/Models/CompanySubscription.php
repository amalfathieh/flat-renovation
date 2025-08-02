<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'subscription_plan_id', 'start_date', 'end_date', 'status'
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    // علاقة مع SubscriptionPlan
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    // علاقة مع Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function projects()
    {
        return $this->belongsTo(Project::class);
    }



    public function transactionsAll()
    {
        return $this->morphMany(TransactionsAll::class, 'related');
    }


}
