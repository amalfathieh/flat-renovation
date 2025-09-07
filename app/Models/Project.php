<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    use HasFactory;


    protected $fillable = [
        'company_id',
        'customer_id',
        'order_id',
        'employee_id',
        'project_name',
        'start_date',
        'end_date',
        'status',
        'description',
        'final_cost',
        'is_publish',
        'file',

    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',
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

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function ratings()
    {
        return $this->hasOne(ProjectRating::class);
    }


    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }





    public function projectStages()
    {

        return $this->hasMany(ProjectStage::class);
    }

//    public function images() {
//        return $this->hasMany(Image::class);
//    }

//    public function objections() {
//        return $this->hasMany(Objection::class);
//    }



    protected $appends = ['duration_in_days'];

    public function getDurationInDaysAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return null;
        }

        return Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date));
    }
}

