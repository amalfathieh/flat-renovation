<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment_method extends Model
{


    protected $fillable = [
        'name',
        'is_active',
        'instructions',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'instructions' => 'array',
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];


    public function topUpRequests()
    {
        return $this->hasMany(Top_up_request::class);
    }

}
