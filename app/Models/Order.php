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
        'status',
        'cost_of_examination',
        'location',
        'budget',
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



    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
