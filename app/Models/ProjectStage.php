<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectStage extends Model
{
    protected $fillable = [
        'project_id', 'title', 'description', 'started_at', 'completed_at'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
