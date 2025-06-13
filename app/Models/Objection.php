<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objection extends Model
{
    // app/Models/Objection.php
    protected $fillable = [
        'project_id', 'user_id', 'text',
    ];


    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }







}
