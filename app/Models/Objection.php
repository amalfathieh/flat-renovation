<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objection extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_stage_id',
        'customer_id',
        'text',
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];




    public function projectStage() {
        return $this->belongsTo(ProjectStage::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function company()
    {
        return $this->hasOneThrough(
            \App\Models\Company::class,
            \App\Models\ProjectStage::class,
            'id', // Foreign key on ProjectStage (used in Objection)
            'id', // Foreign key on Company (used in Project)
            'project_stage_id', // Local key on Objection
            'project_id' // Local key on ProjectStage
        )->join('projects', 'projects.id', '=', 'project_stages.project_id');
    }




}
