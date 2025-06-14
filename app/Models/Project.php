<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'order_id',
        'employee_id',
        'project_name',
        'start_date',
        'end_date',
        'status',
        'description',
        'final_cost',
        'rate',
        'comment'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function projectImages()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }



    public function stages() {
        return $this->hasMany(ProjectStage::class);
    }

//    public function images() {
//        return $this->hasMany(Image::class);
//    }

//    public function objections() {
//        return $this->hasMany(Objection::class);
//    }


}

