<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionService extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id', 'question',
    ];
    public function service() {
        return $this->belongsTo(Service::class);
    }


    public function answer() {
        return $this->hasOne(answer::class);
    }


}
