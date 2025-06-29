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





}
