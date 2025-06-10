<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id', 'name', 'slug', 'logo', 'location', 'about'
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }

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

    public function services(){
        return $this->hasMany(Service::class);
    }
}
