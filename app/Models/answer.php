<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_service_id',
        'order_id',
        'answer',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function questionService()
    {
        return $this->belongsTo(QuestionService::class);
    }
    //
}
