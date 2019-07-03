<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $casts = [
        'operations'     => 'array',
        'sub_operations' => 'array',
        'credit_score'   => 'array'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function status()
    {
        return $this->belongsTo(CompanyStatus::class, 'status_id');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function branches()
    {
        return $this->hasMany(CompanyBranch::class, 'company_id');
    }

    public function contacts()
    {
        return $this->hasMany(CompanyContact::class, 'company_id');
    }

    public function workSchedules()
    {
        return $this->hasMany(WorkSchedule::class, 'company_id');
    }
}
