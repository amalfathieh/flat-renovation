<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empolyee extends Model
{
    protected $guarded = [
    ];

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
