<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'company_id', 'employee_id','status','notes'
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
