<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //

    protected $fillable = ['name', 'description'];

    public function company(){
        return $this->belongsTo(Company::class);
    }


    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }


}
