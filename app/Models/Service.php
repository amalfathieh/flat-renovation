<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //

    protected $fillable = ['name', 'description', 'image'];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function serviceTypes(){
        return $this->hasMany(ServiceType::class);
    }

}
