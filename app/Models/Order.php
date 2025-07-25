<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'company_id',
        'employee_id',
        'status',
        'cost_of_examination',
        'location',
        'budget',
         'payment_intent_id',
         'refund_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];


    public function customer() {
        return $this->belongsTo(Customer::class);
    }



    public function company() {
        return $this->belongsTo(Company::class);
    }


    public function project() {
        return $this->hasOne(Project::class);
    }


    public function answers() {
        return $this->hasMany(Answer::class);
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
