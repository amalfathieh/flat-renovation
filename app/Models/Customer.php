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
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
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

    public function projectRatings()
    {
        return $this->hasMany(ProjectRating::class);
    }





    public function stageTransactions()
    {
        return $this->hasMany(stage_transactions::class);
    }





    public function sentTransactions()
    {
        return $this->morphMany(TransactionsAll::class, 'payer');
    }


    public function receivedTransactions()
    {
        return $this->morphMany(TransactionsAll::class, 'receiver');
    }



    public function topUpRequests()
    {
        return $this->morphMany(Top_up_request::class, 'requester');
    }



    public function favorite()
    {
        return $this->belongsToMany(Company::class, 'favorites')->withTimestamps();
    }
    public function conversation()
    {
        return $this->hasMany(Conversation::class);
    }

}
