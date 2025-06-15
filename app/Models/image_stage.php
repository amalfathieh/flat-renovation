<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image_stage extends Model
{
    use HasFactory;

    protected $fillable = ['image','project_stage_id'];

    public function projectStage() {

        return $this->belongsTo(ProjectStage::class);
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
