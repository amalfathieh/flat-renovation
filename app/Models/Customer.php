<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'image',
        'age',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function objections() {
        return $this->hasMany(Objection::class);
    }


    public function orders() {
        return $this->hasMany(Order::class);
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
