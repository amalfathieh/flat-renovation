<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id', 'name', 'email', 'slug', 'location', 'phone', 'about', 'logo', 'cost_of_examination',

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d\TH:i:s',
        'updated_at' => 'datetime:Y-m-d\TH:i:s',

    ];


    public function user() {
        return $this->belongsTo(User::class);
    }


//    public function employees(){
//        return $this->hasMany(Employee::class);
//    }

//    public function owner()
//    {
//        return $this->belongsTo(User::class, 'user_id');
//    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getBrandLogo()
    {
        if ($this->logo){
            return asset('storage/'.$this->logo);
        }
        return asset('images/logo.svg');

    }

    public function serviceTypes(){
        return $this->hasManyThrough(
            ServiceType::class,
            Service::class,
            'company_id',
            'service_id',
            'id',
            'id',
        );
    }
    public function projectStages(){
        return $this->hasManyThrough(
            ProjectStage::class,
            Project::class,
            'company_id',
            'project_id',
            'id',
            'id',
        );
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }
    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function stageTransactions()
    {
        return $this->hasMany(stage_transactions::class);
    }


    public function projectRatings()
    {
        return $this->hasManyThrough(
            \App\Models\ProjectRating::class,
            \App\Models\Project::class,
            'company_id',
            'project_id',
            'id',
            'id'
        );
    }

    public function activeSubscription()
    {
        return $this->hasOne(CompanySubscription::class)
            ->where('status', 'active')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now());
    }

    public function canCreateProject()
    {
        // إذا لم يكن هناك اشتراك فعال
        if (!$this->activeSubscription) {
            return false;
        }

        $activeProjectsCount = $this->activeSubscription->used_projects;

        return $activeProjectsCount < $this->activeSubscription->subscriptionPlan->project_limit;
    }

//  // علاقة مع CompanySubscriptions
    public function companySubscriptions()
    {
        return $this->hasMany(CompanySubscription::class);
    }


// app/Models/Company.php

    public function favoredByCustomers()
    {
        return $this->belongsToMany(Customer::class, 'favorite')->withTimestamps();
    }


    public function sentTransactions()
    {
        return $this->morphMany(TransactionsAll::class, 'payer');
    }


    public function receivedTransactions()
    {
        return $this->morphMany(TransactionsAll::class, 'receiver');
    }



    public function topUpRequests()
    {
        return $this->morphMany(Top_up_request::class, 'requester');
    }


}


