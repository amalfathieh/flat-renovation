<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [
    ];

    protected static function booted()
    {
        static::deleting(function ($employee){
            $employee->user?->delete();
        });
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
