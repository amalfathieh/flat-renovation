<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empolyee extends Model
{
    protected $fillable = [

    ];

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
