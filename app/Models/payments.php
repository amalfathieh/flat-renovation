<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];
}
