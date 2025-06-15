<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStage extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'stage_name',
        'description',
        'started_at',
        'completed_at',
        'status',
        'cost',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function ImageStage() {

        return $this->hasMany(image_stage::class);
    }

    public function objections() {
        return $this->hasMany(Objection::class);
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
