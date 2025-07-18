<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id', 'name', 'email', 'slug', 'location', 'phone', 'about', 'logo', 'cost_of_examination'

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',

    ];


    public function user() {
        return $this->belongsTo(User::class);
    }


//    public function employees(){
//        return $this->hasMany(Employee::class);
//    }

//    public function owner()
//    {
//        return $this->belongsTo(User::class, 'user_id');
//    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getBrandLogo()
    {
        if ($this->logo){
            return asset('storage/'.$this->logo);
        }
        return asset('images/logo.svg');

    }

    public function serviceTypes(){
        return $this->hasManyThrough(
            ServiceType::class,
            Service::class,
            'company_id',
            'service_id',
            'id',
            'id',
        );
    }
    public function projectStages(){
        return $this->hasManyThrough(
            ProjectStage::class,
            Project::class,
            'company_id',
            'project_id',
            'id',
            'id',
        );
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }
    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }


    public function projectRatings()
    {
        return $this->hasManyThrough(
            \App\Models\ProjectRating::class,
            \App\Models\Project::class,
            'company_id',
            'project_id',
            'id',
            'id'
        );
    }



}


