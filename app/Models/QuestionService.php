<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionService extends Model
{
    use HasFactory;
    protected $fillable = [

        'service_id', 'question','has_options',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];


    public function service() {
        return $this->belongsTo(Service::class);
    }


    public function answer() {
        return $this->hasOne(answer::class);
    }




}
