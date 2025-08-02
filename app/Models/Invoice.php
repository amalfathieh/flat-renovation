<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // علاقة مع CompanySubscription
    public function companySubscription()
    {
        return $this->belongsTo(CompanySubscription::class);
    }

    // علاقة مع Company (اختياري إذا كان لديك حاجة لربط الفاتورة مباشرة مع الشركة)
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
