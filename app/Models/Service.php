<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','name', 'description', 'image'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];



    public function company(){
        return $this->belongsTo(Company::class);
    }


    public function serviceTypes(){
        return $this->hasMany(ServiceType::class);
    }


    public function questions() {
        return $this->hasMany(QuestionService::class);
    }

    public function projectSatge()
    {
        return $this->hasOne(ProjectStage::class);
    }

}
