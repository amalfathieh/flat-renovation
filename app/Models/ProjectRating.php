<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRating extends Model
{
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
