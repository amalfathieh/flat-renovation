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

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function questionService()
    {
        return $this->belongsTo(QuestionService::class);
    }


}
