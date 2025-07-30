<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
      'name', 'price', 'project_limit', 'duration_in_days', 'description', 'is_active'
    ];

//    // علاقة مع CompanySubscriptions
    public function companySubscriptions()
    {
        return $this->hasMany(CompanySubscription::class);
    }

}
