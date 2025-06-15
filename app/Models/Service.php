<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','name', 'description', 'image'];


    public function company(){
        return $this->belongsTo(Company::class);
    }


    public function serviceTypes(){
        return $this->hasMany(ServiceType::class);
    }


    public function questions() {
        return $this->hasMany(QuestionService::class);
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
