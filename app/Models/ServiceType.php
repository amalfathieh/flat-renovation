<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{

    protected $fillable = ['service_id', 'name', 'description', 'unit', 'price_per_unit'];

    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

    public function company(){
        return $this->service?->company();
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
