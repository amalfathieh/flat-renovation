<?php

namespace App\Models;


use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements  HasTenants, FilamentUser, MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'email_verified_at',
        'banned_at'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() == 'admin') {
            return $this->hasRole('admin');
        }

        if ($panel->getId() == 'company') {

            if ($this->hasRole('employee')) {
                return $this->employee && $this->employee->company_id !== null;
            }

            if ($this->hasRole('company')) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function getTenants(Panel $panel): Collection|array
    {
        if ($this->hasRole('employee') && $this->employee) {

            return collect([$this->employee->company]);
        }

        if ($this->hasRole('company') && $this->company){

            return collect([$this->company]);
        }
        return  collect();
    }

    public function canAccessTenant(Model $tenant): bool
    {
        if ($this->hasRole('employee')) {

            return $this->employee && $this->employee->company_id == $tenant->id;
        }

        if ($this->hasRole('company')){

            return $this->company || $this->company()->whereKey($tenant)->exists();
        }

        return false;
    }

    public function getFilamentAvatarUrl()
    {
        $user = auth()->user();
        if($this->company() &&$this->company->logo){
            return Storage::disk('public')->url($this->company->logo);
        }
        return asset('images/logo.jpg');
    }
    public function customerProfile()
    {
        return $this->hasOne(Customer::class);
    }

}
