<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
      'user_id', 'company_name', 'location', 'about'
    ];

    public function logo()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
