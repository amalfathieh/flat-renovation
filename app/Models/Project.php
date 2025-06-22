<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{


    //oooppp Hiba 0983449075
    use HasFactory;
    protected $fillable = [
        'company_id',
        'order_id',
        'employee_id',
        'project_name',
        'start_date',
        'end_date',
        'status',
        'description',
        'final_cost',
        'rate',
        'comment'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function projectImages()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function ratings()
    {
        return $this->hasMany(ProjectRating::class);
    }


    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }


    public function stages() {
        return $this->hasMany(ProjectStage::class);
    }

//    public function images() {
//        return $this->hasMany(Image::class);
//    }

//    public function objections() {
//        return $this->hasMany(Objection::class);
//    }



    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    protected $appends = ['duration_in_days']; // لإضافته تلقائيًا في JSON

    public function getDurationInDaysAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return null;
        }

        return Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date));
    }
}

