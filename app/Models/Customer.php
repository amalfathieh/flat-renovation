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


    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function objections() {
        return $this->hasMany(Objection::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }


    public function orders() {
        return $this->hasMany(Order::class);
    }


    public function projectRatings()
    {
        return $this->hasMany(ProjectRating::class);
    }



    public function stageTransactions()
    {
        return $this->hasMany(stage_transactions::class);
    }


}
