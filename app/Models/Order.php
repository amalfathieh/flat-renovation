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

    //
    public function customer() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }

    public function project() {
        return $this->hasOne(Project::class);
    }

}
