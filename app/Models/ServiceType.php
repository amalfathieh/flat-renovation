<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    protected $fillable = ['service_id', 'name', 'description', 'unit', 'price_per_unit','image'];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];



//    public function images()
//    {
//        return $this->morphMany(Image::class,'imageable');
//    }

    public function company(){
        return $this->service?->company();
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function satge()
    {
        return $this->hasOne(ProjectStage::class);
    }
}
