<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image_stage extends Model
{
    use HasFactory;

    protected $fillable = ['image','project_stage_id','description','stage_date'];



    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];

    public function projectStage() {

        return $this->belongsTo(ProjectStage::class);
    }

}
