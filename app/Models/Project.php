<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'order_id', 'project_name', 'description','cost_final'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
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

    public function objections() {
        return $this->hasMany(Objection::class);
    }


}

