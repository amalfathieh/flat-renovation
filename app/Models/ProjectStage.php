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
        'service_id',
        'service_type_id',
        'description',
        'started_at',
        'completed_at',
        'status',
        'cost',
        'is_confirmed',
        'payment_intent_id',

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



    public function stageTransactions()
    {
        return $this->hasMany(stage_transactions::class, 'project_stage_id');
    }




}
