<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'company_id','first_name','last_name','gender','phone','starting_date','birth_day','description'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];

    protected $guarded = [
    ];

    protected static function booted()
    {
        static::deleting(function ($employee){
            $employee->user?->delete();
        });
    }



    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }

}
