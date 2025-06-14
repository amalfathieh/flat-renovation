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
}
