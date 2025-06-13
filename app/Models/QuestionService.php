<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionService extends Model
{
    protected $fillable = [
        'project_id', 'user_id', 'question',
    ];
    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class, 'question_id');
    }
}
