<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'address',
        'phone',
        'email',
        'reg',
        'vat',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'org_users', 'org_id', 'user_id');
    }

    public function companyStatuses()
    {
        return $this->hasMany(CompanyStatus::class, 'org_id');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'org_id');
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'org_id');
    }

    public function workSchedules()
    {
        return $this->hasMany(WorkSchedule::class, 'org_id');
    }
    
    public function orgs()
    {
        return $this->hasOne(OrgSettings::class, 'org_id');
    }
}
