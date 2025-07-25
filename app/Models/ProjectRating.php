<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRating extends Model
{



    use HasFactory;
    protected $fillable = [
        'project_id',
        'customer_id',
        'rating',
        'comment',

    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
