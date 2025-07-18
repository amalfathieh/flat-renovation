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


    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',

    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function ImageStage() {
        return $this->hasMany(Image_stage::class);

    }

    public function objections() {
        return $this->hasMany(Objection::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }



}
